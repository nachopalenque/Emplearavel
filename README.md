<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<strong><a href="https://github.com/nachopalenque/repositorioPalenque/tree/main/public/docs">Clic aquí para ver la documentación</a></strong><br>
<strong>Proceso de instalación recomendado con docker: </strong><br>
<p>1 - Cree el directorio donde se va instalar la aplicación</p>
<p>2 - Clone o descarge este repositorio en el directorio que acaba de crear</p>
<p>3 - Crear archivo llamado Dockerfile con el siguiente contenido : 
    
    FROM bitnami/laravel:10
    
    WORKDIR /app
    
    COPY Emplearavel/. /app/
    
    RUN curl -sS https://getcomposer.org/installer | php && \
        mv composer.phar /usr/local/bin/composer
    
    RUN composer install --no-dev --optimize-autoloader
    RUN cp /app/.env.example /app/.env
    RUN php artisan key:generate
    RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
    RUN npm install
    RUN npm run build
    
    EXPOSE 8000
    CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


</p>
<p>4 - Crear el archivo llamado docker-compose.yml con el siguiente contenido :

    version: "3.8"
    
    services:
      emplearavel:
        build: .
        restart: unless-stopped
        command: sh -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"
        container_name: emplearavel
        ports:
          - "8000:8000"
        environment:
          DB_HOST: mariadb
          DB_PORT: 3306
          DB_DATABASE: emplearavel
          DB_USERNAME: emplearaveluser
          DB_PASSWORD: emplearavelpass 
        networks:
          - emplearavel  
        depends_on:
          - mariadb
    
      mariadb:
        image: bitnami/mariadb:latest
        restart: unless-stopped
        container_name: mariadb
        environment:
          MARIADB_ROOT_PASSWORD: emplearavelpass
          MARIADB_ROOT_USER: root
          MARIADB_DATABASE: emplearavel
          MARIADB_USER: emplearaveluser
          MARIADB_PASSWORD: emplearavelpass
        ports:
          - "3306:3306"
        volumes:
          - mariadb_data:/var/lib/mysql
        networks:
          - emplearavel
    
    volumes:
      mariadb_data:
      
    networks:
      emplearavel:
        driver: bridge 



</p>
<p>5 - Ejecutar docker compose : 
    
        docker-compose up -d
</p>
<p><strong>Nota: Probablemente para finalizar el despligue de la aplicación sea necesario volver a arrancar del contenedor de mariadb
Comprobamos que esta activo con : docker ps -a <br>
Y si no lo esta ejecutamos : docker start mariadb</strong>
</p>




## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
