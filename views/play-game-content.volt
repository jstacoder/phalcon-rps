{% extends 'play-game.volt' %}
{% block content %}
    <div class=row>
    <div class=col-md-3>
    <h3>You picked <span class="label label-default">{{ user_choice }}</span></h3>
    </div>
    <div class=col-md-4>
    <h3>The Computer picked <span class="label label-default">{{ comp_choice }}</span></h3>
    </div>
    <div class=col-md-5>
    <h1 class=lead>Result: <span class="label label-default">You {{ result }}</span></h1>
    </div>
    </div>
        <div class="panel panel-default">
        <div class="text-center panel-body bg-{{ bg }}">
        <h3>{{ quote }}</h3>
        </div>
        </div>
    <a href="/play" class="btn btn-success">play again</a>
{% endblock %}
