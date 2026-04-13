# Desert Current

Desert Current is a portfolio WordPress project for a fictional local media and community publisher in the American Southwest.

The goal is to build something that feels real: a custom theme for local stories, event listings, community-focused pages, and one small React feature that adds interactivity without turning the site into a full JavaScript app.

This repo is intentionally small and focused on the custom build itself: theme code, front-end decisions, and project structure.

## Project goals

- Build a realistic local publisher site with a custom WordPress theme
- Show strong front-end WordPress skills with reusable template parts
- Use free ACF for practical editor-friendly fields
- Use free Elementor only where it makes sense for static pages
- Add one beginner-friendly React feature in a focused, maintainable way
- Keep the project accessible, responsive, and portfolio-ready

## Planned stack

- WordPress
- Custom theme
- Advanced Custom Fields (free)
- Elementor (free)
- React for one small interactive feature

## What lives in this repo

- Project documentation and setup files
- The custom theme code inside `wp-content/themes/desert-current`
- Only the code that shows the work

## What does not live in this repo

- WordPress core
- Uploaded media
- Installed plugin source code
- Local environment files

That keeps the repository easier to read and easier to maintain.

## Recommended local setup

The simplest setup for this project is:

1. Create a local WordPress site with a tool like Local.
2. Keep WordPress core outside version control.
3. Use this repo to store only the custom project code.
4. Build the theme in `wp-content/themes/desert-current`.

If you want, you can keep this repo next to your local WordPress install and symlink the theme folder into the site, or you can work directly inside the site's `wp-content/themes/desert-current` folder if this repo is already there.

## What this project is meant to demonstrate

- Custom WordPress theme development
- Reusable template parts and sensible file organization
- Practical use of ACF for editor-friendly content
- Care with accessibility, responsive layout, and performance
- A small React feature that fits inside a traditional WordPress site

## Why WordPress core should stay out of the repo

For a portfolio project, the custom theme is the important part. WordPress core changes often, adds a lot of noise, and does not show your skill. Keeping core out of the repo makes the project:

- easier to review
- lighter to clone
- easier to explain in interviews
- more focused on your own code

## Current repo shape

```text
desert-current/
├── README.md
├── .gitignore
├── .editorconfig
└── wp-content/
    └── themes/
        └── desert-current/
```

The theme folder will be added as we build the project.

## First build milestone

The next step is to scaffold the custom theme foundation:

- theme stylesheet and metadata
- `functions.php`
- theme setup files
- global header and footer
- starter assets and template parts

## Portfolio note

This project is intentionally scoped to feel like a believable small publisher website. The goal is not to build the biggest possible WordPress project. The goal is to build something thoughtful, clean, and practical that a local media team could realistically use.
