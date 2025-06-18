# 取消镜像
composer config -g --unset repos.packagist

#配置composer镜像源
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

#安装Laravel
# 如果需要安装特定版本的Laravel，可以指定版本号
composer create-project --prefer-dist laravel/laravel your-project-name "12.*"