# Rösti Quiz

**A progressive web application (PWA) for dueling friends with cultural questions about Switzerland**

![GitHub](https://img.shields.io/github/repo-size/websauce-projart/roesti-quiz)
![GitHub](https://img.shields.io/tokei/lines/github/websauce-projart/roesti-quiz)
![GitHub](https://img.shields.io/github/license/websauce-projart/roesti-quiz)

**Website:** [https://pingouin.heig-vd.ch/websauce/]()

## Getting started

### Installation

```shell
$ git clone https://github.com/websauce-projart/roesti-quiz.git
$ cd roesti-quiz
$ composer install
$ npm install
$ php artisan migrate:fresh --seed
```

### Configuration

Duplicate `.env.example` to `.env`, edit it at your will

### Usage

-  `php artisan serve` – Start the server on [localhost:8000](http://localhost:8000)
-  `npm run watch` – Start browsersync on [localhost:3000](http://localhost:3000)
-  `npm run dev` – Build assets for developement
-  `npm run prod` – Build assets for production (minify output)

## Seeding

Seeders and factories from Laravel are used to populate entries in the database.

-  An admin user will be generated with the username `admin` and the password `password`
-  A player will be generated with the username `player` and the password `password`
-  Ten other random players will be added to the database
-  A base of actual questions from the quiz

## Git workflow

### The `main` branch

This branch should always be the last working version. Please make sure your feature is not breaking anything while merging

### Add feature

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

## What it uses

-  [Laravel](https://laravel.com/) – PHP Framework
-  [Vue3](https://vuejs.org/) – Javascript Framework
-  [PostCSS](https://postcss.org/) – Pre-processor, nesting element, autoprefixer, ...
-  [Sanitize.css](https://github.com/csstools/sanitize.css) – Default HTML elements styling

## Good practices

### CSS conventions

[ITCSS](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)

[BEM](http://getbem.com/introduction/)<br>
`.profile__picture`<br>
`.quiz__button--disabled`<br>
`.form__label--valid`

### Git naming

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

### Coding style

[.editorconfig](https://editorconfig.org/) – Helps maintain consistent coding styles

## About

### License

This project is licensed under the terms of the MIT license. See the [LICENSE](LICENSE) file.
