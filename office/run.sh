ln -s ../../api vue/dist/api
echo "++ SYMLINK CREATED!"
php -S $1 -t vue/dist
