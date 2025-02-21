# Vinícius Kobs
# 19/02/2025
#
# DISCLAIMER:
# This script is provided "as is," without warranty of any kind, express or implied.
# The creator is NOT responsible for any damages or data loss that might occur when
# running this script on your system. Use it at your own risk. It is recommended to
# thoroughly review, understand, and test the script in a safe environment before
# running it on a production or personal system.
#
# By proceeding to use this script, you agree that the creator assumes no liability
# for any unintended consequences or damages resulting from its usage.

arch_path="/srv/http/forms/"
ubuntu_path="/var/www/html/forms/"

if [ -f /etc/os-release ]; then
  . /etc/os-release
  OS=$ID
  if [ "$OS" = "arch" ]; then
    if [ ! -d "$arch_path" ]; then
      echo "Creating directory"
      sudo mkdir "$arch_path"
      sudo chown "$USER":"http" "$arch_path"
      chmod 775 "$arch_path"
    else
      rm -rf "$arch_path"*
    fi
    cp -r ./src/* "$arch_path"
    sudo chown -R "$USER":"http" "$arch_path"
    chmod -R 775 "$arch_path"
  elif [ "$OS" = "ubuntu" ]; then
    if [ ! -d "$ubuntu_path" ]; then
      echo "Creating directory"
      sudo mkdir "$ubuntu_path"
      sudo chown "$USER":"www-data" "$ubuntu_path"
      chmod 775 "$ubuntu_path"
    else
      rm -rf "$ubuntu_path"*
    fi
    cp -r ./src/* "$ubuntu_path"
    sudo chown -R "$USER":"www-data" "$ubuntu_path"
    chmod -R 775 "$ubuntu_path"
  else
    echo "Unsupported OS: $OS"
  fi
else
  echo "Couldn't find OS ID"
fi
