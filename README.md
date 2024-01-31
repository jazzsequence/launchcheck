# Launchcheck Test Environment

![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/jazzsequence/launchcheck/test.yml) ![GitHub](https://img.shields.io/github/license/jazzsequence/launchcheck)

This is a test environment based on [Lando](https://docs.lando.dev/) for testing the Pantheon [launchcheck](https://github.com/pantheon-systems/wp_launch_check) [WP-CLI](https://wp-cli.org) command that also powers the Pantheon Status checks in the dashboard.

`wp_launch_check` is installed as a submodule which -- while yucky -- allows development to be done on launchcheck within the environment.

[Composer](https://getcomposer.org) is used to manage plugins and themes within the WordPress environment (although it may be more desirable to test plugin/theme installation using WP-CLI) but not to manage WordPress core itself. Composer scripts for running `wp_launch_check` are included in the `composer.json` file.

## Installation
Before you are able to run `launchcheck` you will need to setup your environment. You can run the `composer launchcheck:init` script to take care of this for you.

`launchcheck:init` also checks for the existence of [`jq`](https://stedolan.github.io/jq/) on your system. Using `jq` is optional, but it can be helpful to more easily parse JSON output when using the `--format=json` flag in `launchcheck` commands, e.g. `lando wp launchcheck config --format=json | jq`.

You can omit the `jq` check and just run the install by using `composer launchcheck:install` instead.

It's possible you might need to install WordPress core before your Lando box will run properly. There's a composer script to help with this as well: `composer install:wp`. This runs a `lando wp core install` using the `wp-config` file in this repository and creates a site with an admin user named `admin` with the password of `admin`.

## Running `launchcheck`
Once the Composer dependencies of `wp_launch_check` are installed (see the installation steps above), you can run the `launchcheck` command in this environment normally using `lando wp launchcheck`. (This is because the `wp_launch_check/vendor/autoload.php` file is included in the `wp-config.php` file.) To see a full list of commands, run `lando wp help launchcheck`.

Some `launchcheck` commands can output their data in JSON syntax using the `--format=json` flag. If you have `jq` installed, you can pipe the output to `jq` to have the JSON pretty-printed, e.g. `lando wp launchcheck config --format=json | jq`.
