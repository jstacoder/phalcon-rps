<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Phalcon PHP Framework</title>
    </head>
    <body{% block body_tag %}{% endblock %}>
        <div class="container">
            <div class="page-header">
                {% block page_header %}
                {% endblock %}
            </div>
            <div class="content row">
                <div class=col-md-12>
                    {% block before_content %}
                    {% endblock %}
                    
                    {% block content %}
                    {% endblock %}

                    {% block after_content %}
                    {% endblock %}
                </div>
            </div>
            <div class="footer row">
                <div class=col-md-3>
                    {% block footer_area_1 %}
                    {% endblock %}
                </div>
                <div class=col-md-3>
                    {% block footer_area_2 %}
                    {% endblock %}
                </div>
                <div class=col-md-3>
                    {% block footer_area_3 %}
                    {% endblock %}
                </div>
                <div class=col-md-3>
                    {% block footer_area_4 %}
                    {% endblock %}
                </div>
            </div>
        </div>
    </body>
</html>
