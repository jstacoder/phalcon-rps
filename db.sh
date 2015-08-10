export MS_HOST=us-cdbr-iron-east-02.cleardb.net
export MS_USER=bf99d8e4dc11e2
export MS_PW=f1a27eb9
export MS_DB=heroku_3a85b8c940595ef

export MS_CMD="mysql -u$MS_USER -p$MS_PW -h$MS_HOST $MS_DB < schema.sql"

$MS_CMD

