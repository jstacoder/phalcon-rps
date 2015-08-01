<ul class="navbar" style="border:1px solid red;">
    {% if navlinks %}
        {% for idx in [3,2,1] %}
            {% for link in navlinks %}
                {% if link.order == idx %}
                    {% set currLink = link %}
                {% endif %}
            {% endfor %}
            <li{% if currLink.active %} class=active{% endif %}>
                <a href="{{ currLink.href }}">
                    {{ currLink.text }}
                </a>
            </li>            
        {% endfor %}
    {% else %}
        <li>item1</li>
        <li>item2</li>
        <li>item3</li>
    {% endif %}
    {% if current_player %}
        <li>{{ current_player }}</li>
    {% endif %}
</ul>
