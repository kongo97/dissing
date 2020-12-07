# SET UP POSTGRESQL (UBUNTU 20.04)


## INSTALL PG & CREATE USER, DB 
- (follow this [step by step guide](https://www.digitalocean.com/community/tutorials/how-to-install-postgresql-on-ubuntu-20-04-quickstart))
    ```
    sudo apt update
    sudo apt install postgresql postgresql-contrib
    ```
- Login admin: `sudo -i -u postgres`
- create superuser and db
    ```
    createuser -P dev
    createdb dissing
    ```
  set user and db config in your .env file

- ALLOW REMOTE ACCESS: follow this [step by step guide](https://support.plesk.com/hc/en-us/articles/115003321434-How-to-enable-remote-access-to-PostgreSQL-server-on-a-Plesk-server-)
  - add to `/etc/postgresql/12/main/postgresql.conf` 
    ```
    listen_addresses = '*'
    ```
  - add to `/etc/postgresql/12/main/pg_hba.conf`
    ```
    host all all 0.0.0.0/0 md5
    ```
  - RESTART PG: `service postgresql restart`
  - Test login a db da remoto: `psql -h 192.168.1.143 -U dev -p 5432 upb2b`