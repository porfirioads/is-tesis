#!/bin/bash

# Get latest code
echo "Getting latest code"
cd tesis-ing-software || exit
git checkout DeployTest
git pull origin DeployTest
cd ..
sudo chown -R www:ubuntu tesis-ing-software
sudo chmod -R 775 tesis-ing-software

# Build
echo "Building project"
cd tesis-ing-software || exit
bash bashcmd/docker_repair.sh
bash bashcmd/docker_reboot.sh
bash bashcmd/laravel_install.sh
sleep 2
bash bashcmd/laravel_migrate_database.sh
sleep 2
echo ""

# Testing
echo "Executing tests"
bash bashcmd/test_unit.sh
bash bashcmd/test_feature.sh
echo ""
