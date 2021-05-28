# Roesti Quiz

**A progressive web application (PWA) for dueling friends with culture question about Switzerland**

![GitHub](https://img.shields.io/github/license/websauce-projart/roesti-quiz)

## Getting started

### Installation

```shell
$ git clone https://github.com/websauce-projart/roesti-quiz.git
$ cd roesti-quiz
$ composer install
$ npm install
```

### Configuration

Duplicate `.env.example` to `.env`, edit it at your will

### Usage

-   `php artisan serve` – Start the server on `localhost:8000`
-   `npm run watch` – Start browsersync on `localhost:3000`
-   `npm run dev` – Build assets for developement
-   `npm run prod` – Build assets for production (minify output)

## Workflow

**`main` branch**
This branch should always be the last working version. Please make sure your feature is not breaking anything while merging

**Add feature**

1. Make sur to have the last version of the main branch: `git pull`
2. Create new branch and go on it: `git checkout -b <name>`
3. Start coding, add stuff and commit on your working branch
4. You can push the branch on the repo if you're not done: `git push -u origin <name>`
5. Merging your branch on the main branch:

```shell
$ git checkout main
$ git pull origin main
$ git merge <name>
```

6. You can now delete your branch: `git branch -d <name>`
7. Don't forget to push everything on the repo: `git push origin main`

## Technologies

**Frameworks**

-   [Laravel](https://laravel.com/) – PHP Framework
-   [Vue3](https://vuejs.org/) – Javascript Framework

**CSS**

-   [PostCSS](https://postcss.org/) – Pre-processor, nesting element, autoprefixer, ...
-   [Sanitize.css](https://github.com/csstools/sanitize.css) – Default HTML elements styling

## Good practices

**CSS conventions**

[ITCSS](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)

[BEM](http://getbem.com/introduction/)<br>
`.profile__picture`<br>
`.quiz__button--disabled`<br>
`.form__label--valid`

**Git naming**<br>
_Convention naming examples_

Branches:<br>
`feat-add-user`<br>
`fix-quiz-timing`<br>
`refactor-method-names`<br>
…

Commit:<br>
`Add contact form`<br>
`Change main button animation delay`<br>
`Remove unused CSS`<br>
…

**Coding style**<br>
[.editorconfig](https://editorconfig.org/) – Helps maintain consistent coding styles

## About

### License

This project is licensed under the terms of the MIT license. See the [LICENSE](LICENSE) file.
