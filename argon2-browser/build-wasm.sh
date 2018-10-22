#!/usr/bin/env bash
cmake \
    -DOUTPUT_NAME="argon2" \
    -DCMAKE_TOOLCHAIN_FILE=$EMSCRIPTEN/cmake/Modules/Platform/Emscripten.cmake \
    -DCMAKE_VERBOSE_MAKEFILE=OFF \
    -DCMAKE_BUILD_TYPE=MinSizeRel \
    -DCMAKE_C_FLAGS="-O3" \
    -DCMAKE_EXE_LINKER_FLAGS="-O3 -g0 --memory-init-file 0 -s NO_FILESYSTEM=1 -s 'EXPORTED_FUNCTIONS=[\"_argon2_hash\",\"_argon2_error_message\"]' -s DEMANGLE_SUPPORT=0 -s ASSERTIONS=0 -s NO_EXIT_RUNTIME=1 -s TOTAL_MEMORY=16MB -s BINARYEN_MEM_MAX=2147418112 -s WASM=1" && cmake --build .
perl -pi -e 's/"argon2.js.mem"/null/g' dist/argon2.js
uglifyjs dist/argon2.js -o dist/argon2.min.js -b beautify=false,ascii_only=true
