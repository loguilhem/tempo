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

/* :lists:touttemps.html.twig */
class __TwigTemplate_20e12f8172a1ce9ac3a31e9801e7ed2a2459672a0566b285b4c804c85690f2a1 extends \Twig\Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", ":lists:touttemps.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", ":lists:touttemps.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", ":lists:touttemps.html.twig", 1);
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
    ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 5, $this->source); })()), "flashes", [0 => "success"], "method", false, false, false, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 6
            echo "        <div class=\"success\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 8, $this->source); })()), "flashes", [0 => "error"], "method", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 9
            echo "        <div class=\"error\">";
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "</div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "
    <div class=\"pageTitle\">
        Tous mes temps
    </div>
    <br>
    <table id=\"\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
        <tr>
            <th>ID</th>
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
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listTemps"]) || array_key_exists("listTemps", $context) ? $context["listTemps"] : (function () { throw new RuntimeError('Variable "listTemps" does not exist.', 31, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["Temps"]) {
            // line 32
            echo "            <tr>
                <td>";
            // line 33
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "id", [], "any", false, false, false, 33), "html", null, true);
            echo "</td>
                <td>";
            // line 34
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "date", [], "any", false, false, false, 34), "d/m/Y"), "html", null, true);
            echo "</td>
                <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "exercice", [], "any", false, false, false, 35), "html", null, true);
            echo "</td>
                <td>";
            // line 36
            if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 36) != null)) {
                // line 37
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 37), "numero", [], "any", false, false, false, 37), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 37), "nom", [], "any", false, false, false, 37), "html", null, true);
                echo "
                    ";
            } else {
                // line 39
                echo "                        Dossier inexistant
                    ";
            }
            // line 40
            echo "</td>
                <td>";
            // line 41
            if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 41) != null)) {
                // line 42
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 42), "numero", [], "any", false, false, false, 42), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "tache", [], "any", false, false, false, 42), "intitule", [], "any", false, false, false, 42), "html", null, true);
            } else {
                // line 43
                echo "                        Tâche inexistante
                    ";
            }
            // line 44
            echo "</td>
                <td>";
            // line 45
            if ((twig_get_attribute($this->env, $this->source, $context["Temps"], "collaborateur", [], "any", false, false, false, 45) != null)) {
                // line 46
                echo "                        ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Temps"], "collaborateur", [], "any", false, false, false, 46), "username", [], "any", false, false, false, 46), "html", null, true);
                echo "
                    ";
            } else {
                // line 48
                echo "                        Collaborateur inexistant
                    ";
            }
            // line 49
            echo "</td>
                <td>";
            // line 50
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "tempspasse", [], "any", false, false, false, 50), "html", null, true);
            echo "</td>
                <td><a href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("modtemps", ["id" => twig_get_attribute($this->env, $this->source, $context["Temps"], "id", [], "any", false, false, false, 51)]), "html", null, true);
            echo "\">Modifier</a></td>
                <td><a class=\"confirmation\" href=\"";
            // line 52
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("deltemps", ["id" => twig_get_attribute($this->env, $this->source, $context["Temps"], "id", [], "any", false, false, false, 52)]), "html", null, true);
            echo "\">Supprimer</a></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Temps'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "        </tbody>
    </table>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return ":lists:touttemps.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  203 => 55,  194 => 52,  190 => 51,  186 => 50,  183 => 49,  179 => 48,  173 => 46,  171 => 45,  168 => 44,  164 => 43,  158 => 42,  156 => 41,  153 => 40,  149 => 39,  141 => 37,  139 => 36,  135 => 35,  131 => 34,  127 => 33,  124 => 32,  120 => 31,  98 => 11,  89 => 9,  84 => 8,  75 => 6,  71 => 5,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    
    {% for message in app.flashes('success') %}
        <div class=\"success\">{{ message }}</div>
    {% endfor %}
    {% for message in app.flashes('error') %}
        <div class=\"error\">{{ message }}</div>
    {% endfor %}

    <div class=\"pageTitle\">
        Tous mes temps
    </div>
    <br>
    <table id=\"\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
        <tr>
            <th>ID</th>
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
            <tr>
                <td>{{ Temps.id }}</td>
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
        {% endfor %}
        </tbody>
    </table>

{% endblock %}
    ", ":lists:touttemps.html.twig", "/home/guilhem/Projects/Temporela/tempo/app/Resources/views/lists/touttemps.html.twig");
    }
}
