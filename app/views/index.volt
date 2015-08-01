<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Phalcon PHP Framework</title>
    </head>
    <body>
        <div class=container>
            {{ partial('partials/nav') }}
            <div class=row>
                <div class=col-md-12>
                    {{ partial("partials/header",{"page_header":page_header | default("TESTING")}) }}
                    {{ flashsession.output() }}
                    {{ content() }}
                </div>
            </div>
        </div>
<script>
    function getAlert(){
        var alerts = document.querySelectorAll('.alert');
        return alerts.length ? alerts[0] : false;
    }
    function killAlert(){
        var alert = getAlert();
        alert && alert.remove();
    }
    function checkAndKill(){
        if(getAlert()){
            killAlert();
        }
    }
    setInterval(killAlert,4000);
</script>
    </body>
</html>
