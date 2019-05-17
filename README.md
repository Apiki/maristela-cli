# Maristela CLI [![Build Status](https://scrutinizer-ci.com/g/Apiki/maristela-cli/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Apiki/maristela-cli/build-status/develop) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Apiki/maristela-cli/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Apiki/maristela-cli/?branch=develop)
Generate pure html files based on a PHP file and a mock.
## Requiriments
1. Folder structure:
```
.
└── components/
    ├── card/
    │   ├── index.php
    │   └── mock.json
    └── header/
        ├── index.php
        └── mock.json
```
2. Component **card** as example:

**index.php**
```html
<div>
    <div><?php echo $title; ?></div>
    <ul>
        <?php foreach ($items as $item) : ?>
        <li><?php echo $item['name']; ?></li>
        <li><?php echo $item['age']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
```

**mock.json**
```json
{
  "title": "My card",
  "items": [
    {
      "name": "John Doe",
      "age": 24
    },
    {
      "name": "Mary Doe",
      "age": 28
    }
  ]
}
```

## Install
1. Run `composer require --dev apiki/maristela-cli` on terminal;
2. Add a new script on composer.json:
```json
  "scripts": {
    "make:components": "Maristela\\Cli\\App::buildComponents"
  }
```
3. Run `composer make:components` on terminal;
4. Will be generated a `_static` folder inside your `components` folder.
5. You can override default `components` creating a `.maristela-cli.json` on your project and setting a value for `componentsDir`:

**.maristela-cli.json**
```
{
  "componentsDir": "components"
}
```
