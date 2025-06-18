FROM quay.io/centos/centos:stream9-development
LABEL maintainer="jiangfeng.wang@jia1edu.com"
WORKDIR /home/workspace/
COPY epel-release-latest-9.noarch.rpm /home/workspace/rpm/
COPY remi-release-9.rpm /home/workspace/rpm/
COPY centos.repo /etc/yum.repos.d/
COPY centos-addons.repo /etc/yum.repos.d/
RUN yum clean all && \
    yum makecache && \
    yum -y --nogpgcheck install /home/workspace/rpm/epel-release-latest-9.noarch.rpm && \
    yum -y --nogpgcheck install https://mirrors.aliyun.com/remi/enterprise/remi-release-9.rpm && \
    yum module reset php -y && \
    yum module enable php:remi-8.2 -y && \
    yum install -y php-fpm php php-bcmath php-cli php-common php-gd php-imap php-mbstring php-mcrypt php-mysql php-mysqlnd php-pdo php-soap php-tidy php-xml php-xmlrpc php-opcache php-redis php-pecl-mcrypt php-zip && \
    yum -y update && \
    curl -o composer-installer.php https://getcomposer.org/installer  && \
    php composer-installer.php --filename=composer --install-dir=/usr/local/bin && \
    yum -y install nginx && \
    yum -y install git &&\
    yum -y install unzip &&\
    systemctl enable php-fpm && \
    systemctl enable nginx
EXPOSE 80
CMD ["/usr/sbin/init"]