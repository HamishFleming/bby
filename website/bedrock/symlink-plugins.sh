#!/bin/bash
SOURCE_DIR="web/app/custom/plugins"
TARGET_DIR="web/app/plugins"

find "$TARGET_DIR" -type l -exec rm {} \;


for plugin in "$SOURCE_DIR"/*; do
 echo "Symlinking $plugin"
  if [ -d "$plugin" ]; then
    ln -s "$plugin" "$TARGET_DIR/$(basename "$plugin")"
  fi
done
