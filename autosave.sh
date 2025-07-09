#!/bin/bash
while true
do
  git add .
  git commit -m "Auto-save: $(date +'%Y-%m-%d %H:%M:%S')" > /dev/null 2>&1
  git push origin main > /dev/null 2>&1
  sleep 600  # Wait 10 minutes
done
