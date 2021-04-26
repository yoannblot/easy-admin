window.addEventListener("load", function () {
    const rootUrl = document.querySelector('body').getAttribute('data-root-url');

    initSelectValues(rootUrl);
});

function initSelectValues(rootUrl) {
    document.querySelectorAll('form .form-item > select').forEach((selectElement) => {
        const valuesConfiguration = selectElement.getAttribute('data-values');
        const componentName = selectElement.getAttribute('name')
        const url = rootUrl + '&page=values&name=' + componentName + '&values=' + valuesConfiguration;

        fetch(new Request(url)).then(response => {
            if (response.status === 200) {
                return response.json().then(function (values) {
                    autoFillSelectValues(selectElement, values);
                })
            }

            throw new Error('Something went wrong on api server!');
        });
    });
}

function autoFillSelectValues(selectElement, values) {
    let htmlOptions = '';
    for (const [key, value] of Object.entries(values)) {
        htmlOptions += '<option value="' + key + '">' + value + '</option>';
    }

    selectElement.innerHTML += htmlOptions;
}
