find . -iname '*.jpg' -print0 | xargs -0 jpegoptim --strip-all --preserve --totals –all-progressive
find . -iname '*.png' -print0 | xargs -0 optipng -o7 -preserve

