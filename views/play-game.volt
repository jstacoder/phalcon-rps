{% extends 'base.volt' %}

{% block content %}
    <div class="panel panel-default">
        <div class="panel-body text-center">
            <div class=row>
         <div class="col-md-4">
            <div class=panel-{{ winpanel }}>
                <div class=panel-heading>
                    wins
                </div>
                <div class=panel-footer>
                    {{ wins }} {% if added == 'win' %} <span class="text-success glyphicon glyphicon-plus"></span>{% endif %}
                </div>
            </div>
            </div>            
                <div class="col-md-4">
            <div class="panel-{{ losepanel }}">
                <div class=panel-heading>
                    losses
                </div>
                <div class=panel-footer>
                    {{ losses }} {% if added == 'loss' %} <span class="text-danger glyphicon glyphicon-plus"></span>{% endif %}
                </div>
            </div>
            </div>            
                <div class="col-md-4">
            <div class="panel-{{ tiepanel }}">
                <div class=panel-heading>
                    ties
                </div>
                <div class=panel-footer>
                    {{ ties }} {% if added == 'tie' %} <span class="text-warning glyphicon glyphicon-plus"></span>{% endif %}
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <h3>You picked {{ user_choice }}</h3>
    <h3>The Computer picked {{ comp_choice }}</h3>
    <h2 class=lead>Result:  <small>You {{ result }}</small></h2>
        <div class="panel panel-default">
        <div class="text-center panel-body bg-{{ bg }}">
        <h3>{{ quote }}</h3>
        </div>
        </div>
    <a href="/play" class="btn btn-success">play again</a>
{% endblock %}
