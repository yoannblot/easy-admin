window.addEventListener("load", function () {
    const rootUrl = document.querySelector('body').getAttribute('data-root-url');

    initSelectValues(rootUrl);
});

function initSelectValues(rootUrl) {
    document.querySelectorAll('form .form-item > select').forEach((selectElement) => {
        const valuesConfiguration = selectElement.getAttribute('data-values');
        const componentName = selectElement.getAttribute('name')
        const url = rootUrl + '&page=values&name=' + componentName + '&values=' + valuesConfiguration;
        const selectedValue = selectElement.getAttribute('data-selected-value');

        fetch(new Request(url)).then(response => {
            if (response.status === 200) {
                return response.json().then(function (values) {
                    autoFillSelectValues(selectElement, values, selectedValue);
                })
            }

            throw new Error('Something went wrong on api server!');
        });
    });
}

function autoFillSelectValues(selectElement, values, selectedValue) {
    let htmlOptions = '';
    for (const [key, value] of Object.entries(values)) {
        htmlOptions += '<option value="' + key + '"'
        if (key === selectedValue) {
            htmlOptions += ' selected="selected"'
        }
        htmlOptions += '>' + value + '</option>';
    }

    selectElement.innerHTML += htmlOptions;
}
