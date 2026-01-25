# Website

This website is built using [Docusaurus 3](https://docusaurus.io/), a modern static website generator.

### Installation

```
$ yarn install
```

### Local Development

```
$ yarn start
```

This command starts a local development server and opens up a browser window. Most changes are reflected live without having to restart the server.

You can also use one of the 2 configured Dev Containers:

- **Static Site Dev Container**: Lightweight container to preview a [production Docusaurus build](https://docusaurus.io/docs/cli#docusaurus-build-sitedir) (`build/`), like it would be [hosted on GitHub Pages](https://docusaurus.io/docs/deployment#deploying-to-github-pages). This requires that you first run `yarn build` locally to generate the static content.
- **Live Preview Dev Container**: Container that runs Docusaurus in [live mode](https://docusaurus.io/docs/cli#docusaurus-start-sitedir) with hot-reloading for local development.

### Build

```
$ yarn build
```

This command generates static content into the `build` directory and can be served using any static contents hosting service.

## License

HHVM and Hack User Documentation is BSD licensed, as found in the LICENSE file.
