#!/usr/bin/env bash

grep -r "einsteiners.us" ./*

if [ $? == 0 ]
  then
    exit 1
fi
