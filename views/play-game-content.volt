{% extends 'play-game.volt' %}
{% block content %}
    <div class=row>
    <div class=col-md-12>
    <div class=row>
    <div class="col-md-9 col-md-offset-3">
    <h3 style="font-size:3em;">You picked <span class="label label-default">{{ user_choice }}</span></h3>
    </div>
    </div>
    <div class=row>
    <div class="col-md-9 col-md-offset-3">
    <h3 style="font-size:3em;">The Computer picked <span class="label label-default">{{ comp_choice }}</span></h3>
    </div>
    </div>
    <div class=row>
    <div class="col-md-9 col-md-offset-3">
    <h1 class=lead style="font-size:3em;">Result: <span class="label label-default">You {{ result }}</span></h1>
    </div>
    </div>
    </div>
    </div>
        <div class="panel panel-default">
        <div class="text-center panel-body bg-{{ bg }}">
        <h3>{{ quote }}</h3>
        </div>
        </div>
    <a href="/play" class="btn btn-success">play again</a>
{% endblock %}
{% block after_content %}
    <div style="text-align:center;font-size:3em;"><p>You {{ result }}</p></div>
{% endblock %}
