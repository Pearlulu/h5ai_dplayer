#!/bin/bash

subdir="/data/video"

function sub(){
    for file in "$1"/*
    do
        if [[ -d "$file" && "${file:0-2}" != "_h5ai" && "${file:0-2}" != "__" ]]; then
            sub "$file"
        else
            if [[ "${file##*.}" == "ass" || "${file##*.}" == "srt" ]]; then
                filenotype="${file%.*}"
                if [[ ! -f "${filenotype}.vtt" ]]; then
                    ffmpeg -i "$file" "${filenotype}.vtt"
                    # rm "$file"
                fi
            fi
        fi
    done
}
sub "$subdir"

echo "sub finish"
