{{ partial("partials/header",{"page_header":page_header | default("TESTING")}) }}
<p>Above common.volt</p>
<ul class=menu>
    <li>ItemA</li>
    <li>ItemB</li>
    <li>ItemC</li>
</ul>
{{ content() }}
<p>Below content</p>
