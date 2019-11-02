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

/* base.html.twig */
class __TwigTemplate_b0d783651ea73112434fd161137f4048f1ffc818f5ffb3c76419cf2585ec682c extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

        <link href=\"https://fonts.googleapis.com/css?family=Oxygen\" rel=\"stylesheet\">
        <link href=\"css/jquery-ui.css\" rel=\"stylesheet\">
        <link href=\"css/jquery.dataTables.min.css\" rel=\"stylesheet\">
        <link href=\"css/buttons.dataTables.min.css\" rel=\"stylesheet\">
        <link href=\"css/chosen.min.css\" rel=\"stylesheet\">
        <link href=\"css/temporela.css\" rel=\"stylesheet\">
        <link href=\"css/temporela-usermanagement.css\" rel=\"stylesheet\">
        <link rel=\"icon\" type=\"image/x-icon\" href=\"images/favicon.ico\" />
        <script src=\"https://kit.fontawesome.com/475b9c34ec.js\" crossorigin=\"anonymous\"></script>

        ";
        // line 17
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 19
        echo "
    </head>
    <body>
        
        <div id='main-menu'>
                ";
        // line 24
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_SUPER_ADMIN")) {
            // line 25
            echo "                    <ul>
                        <li>
                            <a href=\"";
            // line 27
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listusers");
            echo "\"><i class=\"fas fa-users\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Gestion Utilisateurs"), "html", null, true);
            echo "\"></i></a>
                        </li>
                        <li>
                            <a href=\"";
            // line 30
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listdossier");
            echo "\"><i class=\"fas fa-folder\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Gestion des Dossiers"), "html", null, true);
            echo "\"></i></a>
                        </li>
                        <li>
                            <a href=\"";
            // line 33
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listtache");
            echo "\"><i class=\"fas fa-thumbtack\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Gestion des Tâches"), "html", null, true);
            echo "\"></i></a>
                        </li>
                        <li>
                            <a href=\"";
            // line 36
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listtemps");
            echo "\"><i class=\"fas fa-clock\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Gestion du Temps"), "html", null, true);
            echo "\"></i></a>
                        </li>
                        <li>
                            <a href=\"";
            // line 39
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("recap");
            echo "\"><i class=\"fas fa-chart-bar\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Récapitulatif"), "html", null, true);
            echo "\"></i></a>
                        </li>
                    </ul>
                ";
        } elseif ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) {
            // line 43
            echo "                    <ul>
                        <li>
                            <a href=\"";
            // line 45
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listtempscollaborateur");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Gestion du temps"), "html", null, true);
            echo "</a>
                        </li>
                    </ul>
                ";
        } else {
            // line 49
            echo "                    <ul>
                        <li>
                            <a href=\"";
            // line 51
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("fos_user_security_login");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Se connecter"), "html", null, true);
            echo "</a>
                        </li>
                    </ul>
                ";
        }
        // line 54
        echo "            
            </div>
            
        <div id=\"contentAll\">      
                ";
        // line 58
        if ( !(null === twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 58, $this->source); })()), "user", [], "any", false, false, false, 58))) {
            echo "  
                    <div id='current-user'>
                        <a href=\"";
            // line 60
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("fos_user_profile_show");
            echo "\"><i class=\"fas fa-user-tie\" title=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 60, $this->source); })()), "user", [], "any", false, false, false, 60), "username", [], "any", false, false, false, 60), "html", null, true);
            echo "\"></i></a>
                        |
                        <a href=\"";
            // line 62
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("fos_user_security_logout");
            echo "\"><i class=\"fas fa-sign-out-alt\" title=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Quitter"), "html", null, true);
            echo "\"></i></a>
                    </div>
                ";
        }
        // line 65
        echo "
            ";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 66, $this->source); })()), "flashes", [0 => "success"], "method", false, false, false, 66));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 67
            echo "                <div class=\"success\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 69, $this->source); })()), "flashes", [0 => "error"], "method", false, false, false, 69));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 70
            echo "                <div class=\"error\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "            
            ";
        // line 73
        $this->displayBlock('body', $context, $blocks);
        // line 75
        echo "
            <script src=\"js/jquery-1.12.4.js\"></script>
            <script src=\"js/jquery-ui.min.js\"></script>
            <script src=\"js/jquery.dataTables.min.js\"></script>
            <script src=\"js/dataTables.buttons.min.js\"></script>
            <script src=\"js/moment.min.js\"></script>
            <script src=\"js/jszip.min.js\"></script>
            <script src=\"js/pdfmake.min.js\"></script>
            <script src=\"js/vfs_fonts.js\"></script>
            <script src=\"js/buttons.html5.min.js\"></script>
            <script src=\"js/chosen.jquery.js\"></script>
            <script src=\"js/jquery.collection.js\"></script>
            <script src=\"js/temporela.js\"></script>

            ";
        // line 89
        $this->displayBlock('javascripts', $context, $blocks);
        // line 90
        echo "    
        </div>
    </body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Temporela";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 17
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 18
        echo "        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 73
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 74
        echo "            ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 89
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 90
        echo "            ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 90,  302 => 89,  292 => 74,  282 => 73,  272 => 18,  262 => 17,  243 => 5,  229 => 90,  227 => 89,  211 => 75,  209 => 73,  206 => 72,  197 => 70,  192 => 69,  183 => 67,  179 => 66,  176 => 65,  168 => 62,  161 => 60,  156 => 58,  150 => 54,  141 => 51,  137 => 49,  128 => 45,  124 => 43,  115 => 39,  107 => 36,  99 => 33,  91 => 30,  83 => 27,  79 => 25,  77 => 24,  70 => 19,  68 => 17,  53 => 5,  47 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Temporela{% endblock %}</title>

        <link href=\"https://fonts.googleapis.com/css?family=Oxygen\" rel=\"stylesheet\">
        <link href=\"css/jquery-ui.css\" rel=\"stylesheet\">
        <link href=\"css/jquery.dataTables.min.css\" rel=\"stylesheet\">
        <link href=\"css/buttons.dataTables.min.css\" rel=\"stylesheet\">
        <link href=\"css/chosen.min.css\" rel=\"stylesheet\">
        <link href=\"css/temporela.css\" rel=\"stylesheet\">
        <link href=\"css/temporela-usermanagement.css\" rel=\"stylesheet\">
        <link rel=\"icon\" type=\"image/x-icon\" href=\"images/favicon.ico\" />
        <script src=\"https://kit.fontawesome.com/475b9c34ec.js\" crossorigin=\"anonymous\"></script>

        {% block stylesheets %}
        {% endblock %}

    </head>
    <body>
        
        <div id='main-menu'>
                {% if is_granted('ROLE_SUPER_ADMIN') %}
                    <ul>
                        <li>
                            <a href=\"{{ path('listusers') }}\"><i class=\"fas fa-users\" title=\"{{ 'Gestion Utilisateurs'|trans }}\"></i></a>
                        </li>
                        <li>
                            <a href=\"{{ path('listdossier') }}\"><i class=\"fas fa-folder\" title=\"{{ 'Gestion des Dossiers'|trans }}\"></i></a>
                        </li>
                        <li>
                            <a href=\"{{ path('listtache') }}\"><i class=\"fas fa-thumbtack\" title=\"{{ 'Gestion des Tâches'|trans }}\"></i></a>
                        </li>
                        <li>
                            <a href=\"{{ path('listtemps') }}\"><i class=\"fas fa-clock\" title=\"{{ 'Gestion du Temps'|trans }}\"></i></a>
                        </li>
                        <li>
                            <a href=\"{{ path('recap') }}\"><i class=\"fas fa-chart-bar\" title=\"{{ 'Récapitulatif'|trans }}\"></i></a>
                        </li>
                    </ul>
                {% elseif is_granted('ROLE_USER') %}
                    <ul>
                        <li>
                            <a href=\"{{ path('listtempscollaborateur') }}\">{{ 'Gestion du temps'|trans }}</a>
                        </li>
                    </ul>
                {% else %}
                    <ul>
                        <li>
                            <a href=\"{{ path('fos_user_security_login') }}\">{{ 'Se connecter'|trans }}</a>
                        </li>
                    </ul>
                {% endif %}            
            </div>
            
        <div id=\"contentAll\">      
                {% if app.user is not null %}  
                    <div id='current-user'>
                        <a href=\"{{ path('fos_user_profile_show') }}\"><i class=\"fas fa-user-tie\" title=\"{{ app.user.username }}\"></i></a>
                        |
                        <a href=\"{{ path('fos_user_security_logout') }}\"><i class=\"fas fa-sign-out-alt\" title=\"{{ 'Quitter'|trans }}\"></i></a>
                    </div>
                {% endif %}

            {% for message in app.flashes('success') %}
                <div class=\"success\">{{ message }}</div>
            {% endfor %}
            {% for message in app.flashes('error') %}
                <div class=\"error\">{{ message }}</div>
            {% endfor %}
            
            {% block body %}
            {% endblock %}

            <script src=\"js/jquery-1.12.4.js\"></script>
            <script src=\"js/jquery-ui.min.js\"></script>
            <script src=\"js/jquery.dataTables.min.js\"></script>
            <script src=\"js/dataTables.buttons.min.js\"></script>
            <script src=\"js/moment.min.js\"></script>
            <script src=\"js/jszip.min.js\"></script>
            <script src=\"js/pdfmake.min.js\"></script>
            <script src=\"js/vfs_fonts.js\"></script>
            <script src=\"js/buttons.html5.min.js\"></script>
            <script src=\"js/chosen.jquery.js\"></script>
            <script src=\"js/jquery.collection.js\"></script>
            <script src=\"js/temporela.js\"></script>

            {% block javascripts %}
            {% endblock %}    
        </div>
    </body>
</html>
", "base.html.twig", "/home/guilhem/Projects/Temporela/tempo/app/Resources/views/base.html.twig");
    }
}
