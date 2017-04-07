# tips-and-tricks: composer


```json
{
  "name": "bernardosecades/tips-and-tricks-composer",
  "description": "Logger",
  "type": "project",
  "license": "MIT",
  "authors": [
    {
      "name": "bernardosecades",
      "email": "bernardosecades@gmail.com"
    }
  ],
  "autoload": {
    "psr-4": {
      "BernardoSecades\\TipsAndTricks\\Composer\\": "src/"
    }
  },
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/bernardosecades/test"
    },
    {
      "type": "path",
      "url": "../test",
      "options": {
        "symlink": true
      }
    }
  ],
  "require": {
    "bernardosecades/test": "dev-master"
  }
}
```


```json
{
  "name": "bernardosecades/tips-and-tricks-composer",
  "description": "Logger",
  "type": "project",
  "license": "MIT",
  "authors": [
    {
      "name": "bernardosecades",
      "email": "bernardosecades@gmail.com"
    }
  ],
  "autoload": {
    "psr-4": {
      "BernardoSecades\\TipsAndTricks\\Composer\\": "src/"
    }
  },
  "repositories": [
    {
      "packagist": false
    },
    {
      "type": "path",
      "url": "../../test",
      "options": {
        "symlink": true
      }
    }
  ],
  "require": {
    "bernardosecades/test": "dev-master"
  }
}

```