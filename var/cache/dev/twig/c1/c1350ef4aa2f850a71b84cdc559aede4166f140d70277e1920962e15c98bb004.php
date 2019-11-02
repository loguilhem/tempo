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

/* :lists:temps.html.twig */
class __TwigTemplate_22577b89484edeaeabbeb98fa13b8862e74f3a409c7ec6ec2c34e61811328336 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", ":lists:temps.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", ":lists:temps.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", ":lists:temps.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "
    <div class=\"pageTitle\">
        Gestion du temps passé
    </div>
    
    <a href=\"";
        // line 9
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("addtemps");
        echo "\"><input type=\"button\" value=\"+\"></a>
    <br><br><br><br>
    Tableau des temps pour aujourd'hui :
    <br>
    <table id=\"\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
        <tr>
            <th>Date</th>
            <th>Exercice</th>
            <th>Dossier</th>
            <th>Tâche</th>
            <th>Collaborateur</th>
            <th>Temps passé</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listTemps"]) || array_key_exists("listTemps", $context) ? $context["listTemps"] : (function () { throw new RuntimeError('Variable "listTemps" does not exist.', 27, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["Temps"]) {
            // line 28
            echo "            ";
            if ((twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "date", [], "any", false, false, false, 28), "Ymd") == twig_date_format_filter($this->env, "now", "Ymd"))) {
                // line 29
                echo "                <tr>
                    <td>";
                // line 30
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "date", [], "any", false, false, false, 30), "d/m/Y"), "html", null, true);
                echo "</td>
                    <td>";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "exercice", [], "any", false, false, false, 31), "html", null, true);
                echo "</td>
                    <td>";
                // line 32
                if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 32) != null)) {
                    // line 33
                    echo "                            ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 33), "numero", [], "any", false, false, false, 33), "html", null, true);
                    echo " - ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 33), "nom", [], "any", false, false, false, 33), "html", null, true);
                    echo "
                        ";
                } else {
                    // line 35
                    echo "                            Dossier inexistant
                        ";
                }
                // line 36
                echo "</td>
                    <td>";
                // line 37
                if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 37) != null)) {
                    // line 38
                    echo "                            ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 38), "numero", [], "any", false, false, false, 38), "html", null, true);
                    echo " - ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 38), "intitule", [], "any", false, false, false, 38), "html", null, true);
                } else {
                    // line 39
                    echo "                            Tâche inexistante
                        ";
                }
                // line 40
                echo "</td>
                    <td>";
                // line 41
                if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "collaborateur", [], "any", false, false, false, 41) != null)) {
                    // line 42
                    echo "                            ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "collaborateur", [], "any", false, false, false, 42), "username", [], "any", false, false, false, 42), "html", null, true);
                    echo "
                        ";
                } else {
                    // line 44
                    echo "                            Collaborateur inexistant
                        ";
                }
                // line 45
                echo "</td>
                    <td>";
                // line 46
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "tempspasse", [], "any", false, false, false, 46), "html", null, true);
                echo "</td>
                    <td><a href=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("modtemps", ["id" => twig_get_attribute($this->env, $this->source, $context["Temps"], "id", [], "any", false, false, false, 47)]), "html", null, true);
                echo "\">Modifier</a></td>
                    <td><a class=\"confirmation\" href=\"";
                // line 48
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("deltemps", ["id" => twig_get_attribute($this->env, $this->source, $context["Temps"], "id", [], "any", false, false, false, 48)]), "html", null, true);
                echo "\">Supprimer</a></td>
                </tr>
            ";
            }
            // line 51
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Temps'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "        </tbody>
    </table>

    <a href=\"";
        // line 55
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("listalltempscollaborateur");
        echo "\"><input type=\"button\" value=\"Voir tous les temps\"></a>
                 
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return ":lists:temps.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 55,  181 => 52,  175 => 51,  169 => 48,  165 => 47,  161 => 46,  158 => 45,  154 => 44,  148 => 42,  146 => 41,  143 => 40,  139 => 39,  133 => 38,  131 => 37,  128 => 36,  124 => 35,  116 => 33,  114 => 32,  110 => 31,  106 => 30,  103 => 29,  100 => 28,  96 => 27,  75 => 9,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}

    <div class=\"pageTitle\">
        Gestion du temps passé
    </div>
    
    <a href=\"{{ path('addtemps') }}\"><input type=\"button\" value=\"+\"></a>
    <br><br><br><br>
    Tableau des temps pour aujourd'hui :
    <br>
    <table id=\"\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
        <tr>
            <th>Date</th>
            <th>Exercice</th>
            <th>Dossier</th>
            <th>Tâche</th>
            <th>Collaborateur</th>
            <th>Temps passé</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        {% for Temps in listTemps %}
            {% if Temps.date|date('Ymd') == \"now\"|date('Ymd') %}
                <tr>
                    <td>{{ Temps.date|date('d/m/Y') }}</td>
                    <td>{{ Temps.exercice }}</td>
                    <td>{% if Temps.dossier != null %}
                            {{ Temps.dossier.numero }} - {{ Temps.dossier.nom }}
                        {% else %}
                            Dossier inexistant
                        {% endif %}</td>
                    <td>{% if Temps.tache != null %}
                            {{ Temps.tache.numero }} - {{ Temps.tache.intitule }}{% else %}
                            Tâche inexistante
                        {% endif %}</td>
                    <td>{% if Temps.collaborateur != null %}
                            {{ Temps.collaborateur.username }}
                        {% else %}
                            Collaborateur inexistant
                        {% endif %}</td>
                    <td>{{ Temps.tempspasse }}</td>
                    <td><a href=\"{{ path('modtemps', {'id':Temps.id}) }}\">Modifier</a></td>
                    <td><a class=\"confirmation\" href=\"{{ path('deltemps', {'id':Temps.id}) }}\">Supprimer</a></td>
                </tr>
            {% endif %}
        {% endfor %}
        </tbody>
    </table>

    <a href=\"{{ path('listalltempscollaborateur') }}\"><input type=\"button\" value=\"Voir tous les temps\"></a>
                 
{% endblock %}
    ", ":lists:temps.html.twig", "/home/guilhem/Projects/Temporela/tempo/app/Resources/views/lists/temps.html.twig");
    }
}
