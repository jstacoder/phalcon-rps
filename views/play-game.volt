{% extends 'base.volt' %}
{% block body_tag %}
 style="font-size:2em;" 
{% endblock %}
{% block before_content %}
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
{% endblock %}
