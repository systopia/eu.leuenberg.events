#!/bin/sh
# This will regenerate the POT files for your extension's translation,
#  including the values in the json specs for your custom data
#  in resources/*.json.
#
# TODO:
#   1) copy this in the base folder of your extension
#   2) adjust the 'extension_name' variable below
#   3) run it from base folder of your extension: sh ./update_pot.sh
#   4) open your translation with PO-Editor, select "update from POT"
#      and add your new translations
#   5) make sure civi_l10n_tools are available at the given path

extension_name=eu.leuenberg.events
l10n_tools="../civi_l10n_tools"
mkdir -p l10n

# generate temporary php file for the labels of the custom data structures
echo '<?php\n function l10n() {' > l10n.php
cat resources/*.json | grep '"label":' | sed 's/"label": /ts(/' | sed 's/",/");/' >> l10n.php
echo '}' >> l10n.php

# run the string extraction
${l10n_tools}/bin/create-pot-files-extensions.sh ${extension_name} ./ l10n

# clean up
rm l10n.php