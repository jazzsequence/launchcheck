#!/usr/bin/env bash

# Check if jq is installed. If it's not, try a couple ways of installing it.
function check_jq() {
  # Check if jq is already installed.
  if command -v jq &> /dev/null; then
      return # jq is already installed
  fi
  echo -e "${yellow}jq is not installed.${normal}"
  # Check if brew is installed and install jq with it
  if command -v brew &> /dev/null; then
    echo -e "${yellow}Installing jq with Homebrew.${normal}"
    brew install jq
    return
  fi
  # Check if apt-get is installed and install jq with it
  if command -v apt-get &> /dev/null; then
    echo -e "${yellow}Installing jq with apt-get.${normal}"
    sudo apt-get install -y jq
    return
  fi
  echo "${yellow}Attempted to install jq but could not find Brew (for MacOS) or apt-get (for WSL2/Linux).${normal} Exiting here."
  echo "${yellow}It's recommended to use jq for prettier outputs.${normal} But you don't have to."
  echo "You can try installing jq another way and then running the scripts again, piping through jq: https://stedolan.github.io/jq/download/"
  exit 1
}

check_jq
