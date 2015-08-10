{% extends 'base.volt' %}

{% block content %}
    <h3>You picked {{ user_choice }}</h3>
    <h3>The Computer picked {{ comp_choice }}</h3>
    <h2 class=lead>Result:  <small>You {{ result }}</small></h2>
        <div class="panel panel-default">
        <div class=panel-body>
        <h3>{{ quote }}</h3>
        </div>
        </div>
    <a href="/play" class="btn btn-success">play again</a>
{% endblock %}
