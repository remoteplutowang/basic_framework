#docker
docker build ./ -t basic:latest

#设置阿里云centos stream 9 源镜像
>参考文章:https://blog.csdn.net/weixin_54009596/article/details/130597895

#Centos stream 9 官网
>https://www.centos.org/centos-stream/

#配置镜像加速器(镜像地址为阿里的私人镜像加速地址)
> sudo mkdir -p /etc/docker \
> sudo tee /etc/docker/daemon.json <<-'EOF'
> {
>    "registry-mirrors": ["https://docker.1panel.live"]
> }
> EOF \
> sudo systemctl daemon-reload \
> sudo systemctl restart docker 

#配置composer镜像源
> composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
