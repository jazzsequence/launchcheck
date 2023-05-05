# Launchcheck Test Environment

![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/jazzsequence/launchcheck/test.yml) ![GitHub](https://img.shields.io/github/license/jazzsequence/launchcheck)

This is a test environment based on [Lando](https://docs.lando.dev/) for testing the Pantheon [launchcheck](https://github.com/pantheon-systems/wp_launch_check) [WP-CLI](https://wp-cli.org) command that also powers the Pantheon Status checks in the dashboard.

`wp_launch_check` is installed as a submodule which -- while yucky -- allows development to be done on launchcheck within the environment.

[Composer](https://getcomposer.org) is used to manage plugins and themes within the WordPress environment (although it may be more desirable to test plugin/theme installation using WP-CLI) but not to manage WordPress core itself. Composer scripts for running `wp_launch_check` are included in the `composer.json` file.

## Todo
* [ ] Add scripts to run `launchcheck` from the local installation.
* [ ] Update the `.gitignore`
