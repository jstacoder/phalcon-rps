<ul class="navbar" style="border:1px solid red;">
    {% if navlinks %}
        {% for link in navlinks %}
            <li{% if link.active %} class=active{% endif %}>
                <a href="{{ link.href }}">
                    {{ link.text }}
                </a>
            </li>
        {% endfor %}
    {% else %}
        <li>item1</li>
        <li>item2</li>
        <li>item3</li>
    {% endif %}
</ul>
