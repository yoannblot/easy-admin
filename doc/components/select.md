# Select component

Allows a selection from a dropdown list.

```xml

<select name="civility" values="mr+ms+miss" value="miss" bind="civility" allowEmpty="true"/>
```

## Extra attributes

- **allowEmpty** : boolean, if true, then it adds a default empty `<option>` element to the list
- **values** : explain how to retrieve the `<option>` values where to select.

## Values from list

We can retrieve the values from a list.

A `+` symbol must be used as a separator.

To display translations, we have to set in the language files new keys based on the component name.

Following :

```xml

<select name="civility" values="mr+ms+miss"/>
```

In our `lang/fr_FR.lang` file :

```ini
civility.mr = "Monsieur"
civility.ms = "Madame"
civility.miss = "Mademoiselle"
```

This will display:

```html
<select name="civility" id="civility">
    <option value=""></option>
    <option value="mr">Monsieur</option>
    <option value="ms">Madame</option>
    <option value="miss">Mademoiselle</option>
</select>
```

## Values from database

```xml

<select name="civility" values="item:civility|name[LANG]|name[LANG]"/>
```
