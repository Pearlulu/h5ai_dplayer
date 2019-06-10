#!/bin/bash

BASEDIR="/data/video"

function hlsfile(){
	file="$1"
	if [[ "${file##*.}" == "mp4" || "${file##*.}" == "mkv" ]]; then
		filename="${file##*/}"
		m3u8dir="${file%/*}/__${filename}__"
		if [[ ! -d "${m3u8dir}" && ! -f "${file}.aria2" ]]; then
			mkdir -p "${m3u8dir}"
			ffmpeg -i "${file}" -c copy -bsf:v h264_mp4toannexb -hls_time 6 -hls_list_size 0 -hls_segment_filename "${m3u8dir}/%04d.eot" "${m3u8dir}/video.m3u8" >> /data/cloud/hls.log 2>&1
			# echo 'Rikka' > "${file}"
		fi
	fi
}

function scandir(){
	for dirfile in "$1"/*
	do
		if [[ -d "${dirfile}" && "${dirfile:0-5}" != "_h5ai" && "${dirfile:0-2}" != "__" ]]; then
			scandir "${dirfile}"
		else
			hlsfile "${dirfile}"
		fi
	done
}
scandir "${BASEDIR}"

echo "hls finish"
