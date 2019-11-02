<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @WebProfiler/Profiler/toolbar_js.html.twig */
class __TwigTemplate_35fb0aeab8e8fdfd7ff526e0ce171e1b43035b94a1cdd9355659cc174feef3d3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Profiler/toolbar_js.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Profiler/toolbar_js.html.twig"));

        // line 1
        echo "<div id=\"sfwdt";
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 1, $this->source); })()), "html", null, true);
        echo "\" class=\"sf-toolbar sf-display-none\"></div>
";
        // line 2
        echo twig_include($this->env, $context, "@WebProfiler/Profiler/base_js.html.twig");
        echo "
<style";
        // line 3
        if ((isset($context["csp_style_nonce"]) || array_key_exists("csp_style_nonce", $context) ? $context["csp_style_nonce"] : (function () { throw new RuntimeError('Variable "csp_style_nonce" does not exist.', 3, $this->source); })())) {
            echo " nonce=\"";
            echo twig_escape_filter($this->env, (isset($context["csp_style_nonce"]) || array_key_exists("csp_style_nonce", $context) ? $context["csp_style_nonce"] : (function () { throw new RuntimeError('Variable "csp_style_nonce" does not exist.', 3, $this->source); })()), "html", null, true);
            echo "\"";
        }
        echo ">
    ";
        // line 4
        echo twig_include($this->env, $context, "@WebProfiler/Profiler/toolbar.css.twig", ["position" => (isset($context["position"]) || array_key_exists("position", $context) ? $context["position"] : (function () { throw new RuntimeError('Variable "position" does not exist.', 4, $this->source); })()), "floatable" => true]);
        echo "
</style>
<script";
        // line 6
        if ((isset($context["csp_script_nonce"]) || array_key_exists("csp_script_nonce", $context) ? $context["csp_script_nonce"] : (function () { throw new RuntimeError('Variable "csp_script_nonce" does not exist.', 6, $this->source); })())) {
            echo " nonce=\"";
            echo twig_escape_filter($this->env, (isset($context["csp_script_nonce"]) || array_key_exists("csp_script_nonce", $context) ? $context["csp_script_nonce"] : (function () { throw new RuntimeError('Variable "csp_script_nonce" does not exist.', 6, $this->source); })()), "html", null, true);
            echo "\"";
        }
        echo ">/*<![CDATA[*/
    (function () {
        ";
        // line 8
        if (("top" == (isset($context["position"]) || array_key_exists("position", $context) ? $context["position"] : (function () { throw new RuntimeError('Variable "position" does not exist.', 8, $this->source); })()))) {
            // line 9
            echo "            var sfwdt = document.getElementById('sfwdt";
            echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 9, $this->source); })()), "html", null, true);
            echo "');
            document.body.insertBefore(
                document.body.removeChild(sfwdt),
                document.body.firstChild
            );
        ";
        }
        // line 15
        echo "
        Sfjs.load(
            'sfwdt";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 17, $this->source); })()), "html", null, true);
        echo "',
            '";
        // line 18
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("_wdt", ["token" => (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 18, $this->source); })())]), "js"), "html", null, true);
        echo "',
            function(xhr, el) {

                /* Evaluate embedded scripts inside the toolbar */
                var i, scripts = [].slice.call(el.querySelectorAll('script'));

                for (i = 0; i < scripts.length; ++i) {
                    eval(scripts[i].firstChild.nodeValue);
                }

                el.style.display = -1 !== xhr.responseText.indexOf('sf-toolbarreset') ? 'block' : 'none';

                if (el.style.display == 'none') {
                    return;
                }

                if (Sfjs.getPreference('toolbar/displayState') == 'none') {
                    document.getElementById('sfToolbarMainContent-";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 35, $this->source); })()), "html", null, true);
        echo "').style.display = 'none';
                    document.getElementById('sfToolbarClearer-";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 36, $this->source); })()), "html", null, true);
        echo "').style.display = 'none';
                    document.getElementById('sfMiniToolbar-";
        // line 37
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 37, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                } else {
                    document.getElementById('sfToolbarMainContent-";
        // line 39
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 39, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                    document.getElementById('sfToolbarClearer-";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 40, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                    document.getElementById('sfMiniToolbar-";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 41, $this->source); })()), "html", null, true);
        echo "').style.display = 'none';
                }

                /* Handle toolbar-info position */
                var toolbarBlocks = [].slice.call(el.querySelectorAll('.sf-toolbar-block'));
                for (i = 0; i < toolbarBlocks.length; ++i) {
                    toolbarBlocks[i].onmouseover = function () {
                        var toolbarInfo = this.querySelectorAll('.sf-toolbar-info')[0];
                        var pageWidth = document.body.clientWidth;
                        var elementWidth = toolbarInfo.offsetWidth;
                        var leftValue = (elementWidth + this.offsetLeft) - pageWidth;
                        var rightValue = (elementWidth + (pageWidth - this.offsetLeft)) - pageWidth;

                        /* Reset right and left value, useful on window resize */
                        toolbarInfo.style.right = '';
                        toolbarInfo.style.left = '';

                        if (elementWidth > pageWidth) {
                            toolbarInfo.style.left = 0;
                        }
                        else if (leftValue > 0 && rightValue > 0) {
                            toolbarInfo.style.right = (rightValue * -1) + 'px';
                        } else if (leftValue < 0) {
                            toolbarInfo.style.left = 0;
                        } else {
                            toolbarInfo.style.right = '0px';
                        }
                    };
                }
                Sfjs.addEventListener(document.getElementById('sfToolbarHideButton-";
        // line 70
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 70, $this->source); })()), "html", null, true);
        echo "'), 'click', function (event) {
                    event.preventDefault();

                    var p = this.parentNode;
                    p.style.display = 'none';
                    (p.previousElementSibling || p.previousSibling).style.display = 'none';
                    document.getElementById('sfMiniToolbar-";
        // line 76
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 76, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                    Sfjs.setPreference('toolbar/displayState', 'none');
                });
                Sfjs.addEventListener(document.getElementById('sfToolbarMiniToggler-";
        // line 79
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 79, $this->source); })()), "html", null, true);
        echo "'), 'click', function (event) {
                    event.preventDefault();

                    var elem = this.parentNode;
                    if (elem.style.display == 'none') {
                        document.getElementById('sfToolbarMainContent-";
        // line 84
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 84, $this->source); })()), "html", null, true);
        echo "').style.display = 'none';
                        document.getElementById('sfToolbarClearer-";
        // line 85
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 85, $this->source); })()), "html", null, true);
        echo "').style.display = 'none';
                        elem.style.display = 'block';
                    } else {
                        document.getElementById('sfToolbarMainContent-";
        // line 88
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 88, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                        document.getElementById('sfToolbarClearer-";
        // line 89
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 89, $this->source); })()), "html", null, true);
        echo "').style.display = 'block';
                        elem.style.display = 'none'
                    }

                    Sfjs.setPreference('toolbar/displayState', 'block');
                });
                Sfjs.renderAjaxRequests();
                Sfjs.addEventListener(document.querySelector('.sf-toolbar-block-ajax > .sf-toolbar-icon'), 'click', function (event) {
                    event.preventDefault();

                    Sfjs.toggleClass(this.parentNode, 'hover');
                });

                var dumpInfo = document.querySelector('.sf-toolbar-block-dump .sf-toolbar-info');
                if (null !== dumpInfo) {
                    Sfjs.addEventListener(dumpInfo, 'sfbeforedumpcollapse', function () {
                        dumpInfo.style.minHeight = dumpInfo.getBoundingClientRect().height+'px';
                    });
                    Sfjs.addEventListener(dumpInfo, 'mouseleave', function () {
                        dumpInfo.style.minHeight = '';
                    });
                }
            },
            function(xhr) {
                if (xhr.status !== 0) {
                    var sfwdt = document.getElementById('sfwdt";
        // line 114
        echo twig_escape_filter($this->env, (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 114, $this->source); })()), "html", null, true);
        echo "');
                    sfwdt.innerHTML = '\\
                        <div class=\"sf-toolbarreset\">\\
                            <div class=\"sf-toolbar-icon\"><svg width=\"26\" height=\"28\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 26 28\"><path fill=\"#FFF\" d=\"M13 0a13 13 0 1 0 0 26 13 13 0 1 0 0-26zm7 7.5c-.6 0-1-.3-1-.9 0-.2 0-.4.2-.6l.2-.4c0-.3-.5-.4-.7-.4-2 .1-2.5 2.7-2.9 4.8l-.2 1.1c1.1.2 1.9 0 2.4-.3.6-.4-.2-.8-.1-1.3.1-.3.5-.5.8-.6.5 0 .8.5.8 1 0 .8-1.1 2-3.3 1.9l-.7-.1-.5 2.4c-.4 1.7-.9 4.1-2.6 6.2-1.5 1.8-3.1 2.1-3.8 2.1-1.3 0-2.1-.6-2.2-1.6 0-.9.8-1.4 1.3-1.4.7 0 1.2.5 1.2 1.1 0 .5-.2.6-.4.7-.1.1-.3.2-.3.4 0 .1.1.3.4.3.5 0 .9-.3 1.2-.5 1.3-1 1.7-2.9 2.4-6.2l.1-.8.8-3.5c-.9-.7-1.4-1.5-2.6-1.8-.8-.2-1.3 0-1.7.4-.4.5-.2 1.2.2 1.6l.7.7c.8.9 1.3 1.7 1.1 2.7-.3 1.6-2.1 2.8-4.3 2.1-1.9-.6-2.2-1.9-2-2.7.2-.6.7-.8 1.2-.6.5.2.7.8.6 1.3l-.1.3c-.2.1-.3.3-.3.4-.1.4.4.7.8.8.8.3 1.7-.2 1.9-.9.2-.6-.2-1.1-.4-1.2l-.8-.9c-.4-.4-1.2-1.5-.8-2.8.2-.5.5-1 .9-1.4 1-.7 2-.8 3-.6 1.3.4 1.9 1.2 2.8 1.9.5-1.3 1.1-2.6 2-3.8a5 5 0 0 1 3.3-1.8c1.4.2 2.4.8 2.4 1.7 0 .4-.2 1.2-1 1.2z\"/></svg></div>\\
                            An error occurred while loading the web debug toolbar. <a href=\"";
        // line 118
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("_profiler", ["token" => (isset($context["token"]) || array_key_exists("token", $context) ? $context["token"] : (function () { throw new RuntimeError('Variable "token" does not exist.', 118, $this->source); })())]), "html", null, true);
        echo "\">Open the web profiler.</a>\\
                        </div>\\
                    ';
                    sfwdt.setAttribute('class', 'sf-toolbar sf-error-toolbar');
                }
            },
            { maxTries: 5 }
        );
    })();
/*]]>*/</script>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Profiler/toolbar_js.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  239 => 118,  232 => 114,  204 => 89,  200 => 88,  194 => 85,  190 => 84,  182 => 79,  176 => 76,  167 => 70,  135 => 41,  131 => 40,  127 => 39,  122 => 37,  118 => 36,  114 => 35,  94 => 18,  90 => 17,  86 => 15,  76 => 9,  74 => 8,  65 => 6,  60 => 4,  52 => 3,  48 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div id=\"sfwdt{{ token }}\" class=\"sf-toolbar sf-display-none\"></div>
{{ include('@WebProfiler/Profiler/base_js.html.twig') }}
<style{% if csp_style_nonce %} nonce=\"{{ csp_style_nonce }}\"{% endif %}>
    {{ include('@WebProfiler/Profiler/toolbar.css.twig', { 'position': position, 'floatable': true }) }}
</style>
<script{% if csp_script_nonce %} nonce=\"{{ csp_script_nonce }}\"{% endif %}>/*<![CDATA[*/
    (function () {
        {% if 'top' == position %}
            var sfwdt = document.getElementById('sfwdt{{ token }}');
            document.body.insertBefore(
                document.body.removeChild(sfwdt),
                document.body.firstChild
            );
        {% endif %}

        Sfjs.load(
            'sfwdt{{ token }}',
            '{{ path(\"_wdt\", { \"token\": token })|escape('js') }}',
            function(xhr, el) {

                /* Evaluate embedded scripts inside the toolbar */
                var i, scripts = [].slice.call(el.querySelectorAll('script'));

                for (i = 0; i < scripts.length; ++i) {
                    eval(scripts[i].firstChild.nodeValue);
                }

                el.style.display = -1 !== xhr.responseText.indexOf('sf-toolbarreset') ? 'block' : 'none';

                if (el.style.display == 'none') {
                    return;
                }

                if (Sfjs.getPreference('toolbar/displayState') == 'none') {
                    document.getElementById('sfToolbarMainContent-{{ token }}').style.display = 'none';
                    document.getElementById('sfToolbarClearer-{{ token }}').style.display = 'none';
                    document.getElementById('sfMiniToolbar-{{ token }}').style.display = 'block';
                } else {
                    document.getElementById('sfToolbarMainContent-{{ token }}').style.display = 'block';
                    document.getElementById('sfToolbarClearer-{{ token }}').style.display = 'block';
                    document.getElementById('sfMiniToolbar-{{ token }}').style.display = 'none';
                }

                /* Handle toolbar-info position */
                var toolbarBlocks = [].slice.call(el.querySelectorAll('.sf-toolbar-block'));
                for (i = 0; i < toolbarBlocks.length; ++i) {
                    toolbarBlocks[i].onmouseover = function () {
                        var toolbarInfo = this.querySelectorAll('.sf-toolbar-info')[0];
                        var pageWidth = document.body.clientWidth;
                        var elementWidth = toolbarInfo.offsetWidth;
                        var leftValue = (elementWidth + this.offsetLeft) - pageWidth;
                        var rightValue = (elementWidth + (pageWidth - this.offsetLeft)) - pageWidth;

                        /* Reset right and left value, useful on window resize */
                        toolbarInfo.style.right = '';
                        toolbarInfo.style.left = '';

                        if (elementWidth > pageWidth) {
                            toolbarInfo.style.left = 0;
                        }
                        else if (leftValue > 0 && rightValue > 0) {
                            toolbarInfo.style.right = (rightValue * -1) + 'px';
                        } else if (leftValue < 0) {
                            toolbarInfo.style.left = 0;
                        } else {
                            toolbarInfo.style.right = '0px';
                        }
                    };
                }
                Sfjs.addEventListener(document.getElementById('sfToolbarHideButton-{{ token }}'), 'click', function (event) {
                    event.preventDefault();

                    var p = this.parentNode;
                    p.style.display = 'none';
                    (p.previousElementSibling || p.previousSibling).style.display = 'none';
                    document.getElementById('sfMiniToolbar-{{ token }}').style.display = 'block';
                    Sfjs.setPreference('toolbar/displayState', 'none');
                });
                Sfjs.addEventListener(document.getElementById('sfToolbarMiniToggler-{{ token }}'), 'click', function (event) {
                    event.preventDefault();

                    var elem = this.parentNode;
                    if (elem.style.display == 'none') {
                        document.getElementById('sfToolbarMainContent-{{ token }}').style.display = 'none';
                        document.getElementById('sfToolbarClearer-{{ token }}').style.display = 'none';
                        elem.style.display = 'block';
                    } else {
                        document.getElementById('sfToolbarMainContent-{{ token }}').style.display = 'block';
                        document.getElementById('sfToolbarClearer-{{ token }}').style.display = 'block';
                        elem.style.display = 'none'
                    }

                    Sfjs.setPreference('toolbar/displayState', 'block');
                });
                Sfjs.renderAjaxRequests();
                Sfjs.addEventListener(document.querySelector('.sf-toolbar-block-ajax > .sf-toolbar-icon'), 'click', function (event) {
                    event.preventDefault();

                    Sfjs.toggleClass(this.parentNode, 'hover');
                });

                var dumpInfo = document.querySelector('.sf-toolbar-block-dump .sf-toolbar-info');
                if (null !== dumpInfo) {
                    Sfjs.addEventListener(dumpInfo, 'sfbeforedumpcollapse', function () {
                        dumpInfo.style.minHeight = dumpInfo.getBoundingClientRect().height+'px';
                    });
                    Sfjs.addEventListener(dumpInfo, 'mouseleave', function () {
                        dumpInfo.style.minHeight = '';
                    });
                }
            },
            function(xhr) {
                if (xhr.status !== 0) {
                    var sfwdt = document.getElementById('sfwdt{{ token }}');
                    sfwdt.innerHTML = '\\
                        <div class=\"sf-toolbarreset\">\\
                            <div class=\"sf-toolbar-icon\"><svg width=\"26\" height=\"28\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 26 28\"><path fill=\"#FFF\" d=\"M13 0a13 13 0 1 0 0 26 13 13 0 1 0 0-26zm7 7.5c-.6 0-1-.3-1-.9 0-.2 0-.4.2-.6l.2-.4c0-.3-.5-.4-.7-.4-2 .1-2.5 2.7-2.9 4.8l-.2 1.1c1.1.2 1.9 0 2.4-.3.6-.4-.2-.8-.1-1.3.1-.3.5-.5.8-.6.5 0 .8.5.8 1 0 .8-1.1 2-3.3 1.9l-.7-.1-.5 2.4c-.4 1.7-.9 4.1-2.6 6.2-1.5 1.8-3.1 2.1-3.8 2.1-1.3 0-2.1-.6-2.2-1.6 0-.9.8-1.4 1.3-1.4.7 0 1.2.5 1.2 1.1 0 .5-.2.6-.4.7-.1.1-.3.2-.3.4 0 .1.1.3.4.3.5 0 .9-.3 1.2-.5 1.3-1 1.7-2.9 2.4-6.2l.1-.8.8-3.5c-.9-.7-1.4-1.5-2.6-1.8-.8-.2-1.3 0-1.7.4-.4.5-.2 1.2.2 1.6l.7.7c.8.9 1.3 1.7 1.1 2.7-.3 1.6-2.1 2.8-4.3 2.1-1.9-.6-2.2-1.9-2-2.7.2-.6.7-.8 1.2-.6.5.2.7.8.6 1.3l-.1.3c-.2.1-.3.3-.3.4-.1.4.4.7.8.8.8.3 1.7-.2 1.9-.9.2-.6-.2-1.1-.4-1.2l-.8-.9c-.4-.4-1.2-1.5-.8-2.8.2-.5.5-1 .9-1.4 1-.7 2-.8 3-.6 1.3.4 1.9 1.2 2.8 1.9.5-1.3 1.1-2.6 2-3.8a5 5 0 0 1 3.3-1.8c1.4.2 2.4.8 2.4 1.7 0 .4-.2 1.2-1 1.2z\"/></svg></div>\\
                            An error occurred while loading the web debug toolbar. <a href=\"{{ path(\"_profiler\", { \"token\": token }) }}\">Open the web profiler.</a>\\
                        </div>\\
                    ';
                    sfwdt.setAttribute('class', 'sf-toolbar sf-error-toolbar');
                }
            },
            { maxTries: 5 }
        );
    })();
/*]]>*/</script>
", "@WebProfiler/Profiler/toolbar_js.html.twig", "/home/guilhem/Projects/Temporela/tempo/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Profiler/toolbar_js.html.twig");
    }
}
