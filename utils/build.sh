#!/usr/bin/bash

EXECUTABLE=''

if [ `which docker > /dev/null 2>&1 | echo $?` -ne 0 ]
then
    echo "[WARNING] docker executable not found in system..."
    echo "[INFO] Searching for podman..."
    if [`which podman > /dev/null 2>&1 | echo $?` -ne 0 ]
    then
        echo "[ERROR] podman executable also not found in the system..."
        echo "[ERROR] make sure either docker or podman exists. Script existing..." && exit 1
    else
        echo "[INFO] podman executable found in the system. Using podman"
        EXECUTABLE="podman $@"
    fi
else
    echo "docker executable found in system. Using docker"
    EXECUTABLE="docker $@"
fi

source .env

echo "Building container image: ${WEBAPP_CONTAINER_IMAGE_NAME}"
$EXECUTABLE "build" "--no-cache" "-t" "${WEBAPP_CONTAINER_IMAGE_NAME}:${WEBAPP_CONTAINER_IMAGE_VERSION}" "-f" "./images/webapp/Dockerfile" "."

if [ `echo $?` -ne 0 ]
then
    echo "Error during container image building"
    exit 1
fi

echo "Container image building script complete."