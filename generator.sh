#!/bin/sh

SRC="$1"


check_arguments()
{
  if [ $# -ne 1 ]; then
    echo "Expecting exactly one argument"
    exit 1
  fi

  if ! [ -f $SRC ]; then
    echo "Invalid arg $SRC (File expected)"
    exit 1
  fi
}



get_content_one()
{
  local ret=$(grep -m 1 "$1" "$SRC" | awk '{print $2}')
  if [ -z "$ret" ]; then
    echo '-'
    return
  fi
  echo $ret
}



generate_html()
{
  local ori_ifs="$IFS"

  echo "<h1>$(get_content_one __NAME__)</h1>"

  echo "<hr/>"
  echo "<h2>Time</h2>"
  echo "<ul>"
  echo "  <li>Total: $(get_content_one __TIME_TOTAL__)</li>"
  echo "  <li>crafting: $(get_content_one __TIME_CRAFTING__)</li>"
  echo "  <li>backing: $(get_content_one __TIME_BACKING__)</li>"
  echo "</ul>"

  echo "<hr/>"
  echo "<h2>Metadata</h2>"
  echo "<ul>"
  echo "  <li>Quantity: $(get_content_one "__QUANTITY__")</li>"
  echo "  <li>Difficulty: $(get_content_one "__DIFFICULTY__")</li>"
  echo "  <li>Annoyance: $(get_content_one "__ANNOYANCE__")</li>"
  echo "  <li>Threads: $(get_content_one "__THREADS__")</li>"
  echo "</ul>"

  notes=$(grep __NOTE__ "$SRC")
  if ! [ -z "$notes" ]; then
    echo "<hr/>"
    echo "<h2>Notes</h2>"
    echo "<ul>"
    echo "$notes" | while IFS= read -r note; do
      echo "  <li>$(echo $note | awk '{$1=""}1' | sed s/'^ *'//)</li>"
    done
    echo "</ul>"
  fi

  echo "<hr/>"
  echo "<h2>Ingredients</h2>"
  echo "<ul>"
  ingredients=$(grep __INGREDIENT__ "$SRC")
  echo "$ingredients" | while IFS= read -r ingredient; do
    echo "  <li>$(echo $ingredient | awk '{$1=""}1' | sed s/'^ *'//)</li>"
  done
  echo "</ul>"

  echo "<hr/>"
  echo "<h2>Steps</h2>"
  echo "<ul>"
  steps=$(grep __STEP_EN__ "$SRC")
  echo "$steps" | while IFS= read -r step; do
    echo "  <li>$(echo $step | awk '{$1=""}1' | sed s/'^ *'//)</li>"
  done
  echo "</ul>"

  IFS="$ori_ifs"
}



main()
{
  check_arguments $@

  mkdir -p generated/

  $(generate_html > generated/$(basename $SRC))
}
main "$@"
