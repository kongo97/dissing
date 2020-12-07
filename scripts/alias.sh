alias build-dissing='docker build -t dissing .'
alias run-dissing='docker run -d -it -p 8000:8000 --add-host=host.docker.internal:172.17.0.1 -v "$PWD/src":/var/www/html --name dissing dissing'
alias bash-dissing='docker exec -it dissing bash'
alias stop-dissing='docker stop dissing'