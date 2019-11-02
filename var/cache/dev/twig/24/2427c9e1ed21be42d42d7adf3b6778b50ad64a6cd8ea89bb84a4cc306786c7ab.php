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

/* results.html.twig */
class __TwigTemplate_6dc38ee87930927851b6a6f04e21b28e83511bce0314dba941b7c89270a1b1be extends \Twig\Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "results.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "results.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "results.html.twig", 1);
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
        // line 6
        echo "    ";
        if ((isset($context["results"]) || array_key_exists("results", $context))) {
            // line 7
            echo "
        <div class=\"pageTitle\">
            Numéro du Dossier : <b>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["dossier"]) || array_key_exists("dossier", $context) ? $context["dossier"] : (function () { throw new RuntimeError('Variable "dossier" does not exist.', 9, $this->source); })()), "numero", [], "any", false, false, false, 9), "html", null, true);
            echo "</b>
            <br>
            Nom du dossier : <b>";
            // line 11
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["dossier"]) || array_key_exists("dossier", $context) ? $context["dossier"] : (function () { throw new RuntimeError('Variable "dossier" does not exist.', 11, $this->source); })()), "nom", [], "any", false, false, false, 11), "html", null, true);
            echo "</b>
            <br>
            Exercice : <b>";
            // line 13
            echo twig_escape_filter($this->env, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 13, $this->source); })()), "html", null, true);
            echo "</b>
        </div>
        <br>
        <p><b>Temps passé total par tâche :</b></p>
        <br>
        <table id=\"list-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
                <tr>
                    <th>Numéro Tâche</th>
                    <th>Intitulé Tâche</th>
                    <th>Temps passé total</th>
                </tr>
            </thead>
            <tbody>
            ";
            // line 27
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["results"]) || array_key_exists("results", $context) ? $context["results"] : (function () { throw new RuntimeError('Variable "results" does not exist.', 27, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["Tache"]) {
                // line 28
                echo "                <tr>
                    <td>";
                // line 29
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Tache"], "num", [], "any", false, false, false, 29), "html", null, true);
                echo "</td>
                    <td>";
                // line 30
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Tache"], "intitule", [], "any", false, false, false, 30), "html", null, true);
                echo "</td>
                    <td>";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Tache"], "tempstotal", [], "any", false, false, false, 31), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Tache'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "            </tbody>
        </table>
        <br>
        <br>
        <p><b>Détails des temps passés :</b></p>
        <table id=\"list-table-details\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
            <tr>
                <th>Date</th>
                <th>Intitulé Tâche</th>
                <th>Collaborateur</th>
                <th>Temps passé</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["details"]) || array_key_exists("details", $context) ? $context["details"] : (function () { throw new RuntimeError('Variable "details" does not exist.', 49, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["Detail"]) {
                // line 50
                echo "                <tr>
                    <td>";
                // line 51
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Detail"], "date", [], "any", false, false, false, 51), "d/m/Y"), "html", null, true);
                echo "</td>
                    <td>";
                // line 52
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "tache", [], "any", false, false, false, 52), "numero", [], "any", false, false, false, 52), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "tache", [], "any", false, false, false, 52), "intitule", [], "any", false, false, false, 52), "html", null, true);
                echo "</td>
                    <td>";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "collaborateur", [], "any", false, false, false, 53), "username", [], "any", false, false, false, 53), "html", null, true);
                echo "</td>
                    <td>";
                // line 54
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Detail"], "tempspasse", [], "any", false, false, false, 54), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Detail'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "            </tbody>
        </table>

    ";
        }
        // line 61
        echo "


    ";
        // line 65
        echo "    ";
        if ((isset($context["results2"]) || array_key_exists("results2", $context))) {
            // line 66
            echo "
        <div class=\"pageTitle\">
            Collaborateur : <b>";
            // line 68
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["collaborateur"]) || array_key_exists("collaborateur", $context) ? $context["collaborateur"] : (function () { throw new RuntimeError('Variable "collaborateur" does not exist.', 68, $this->source); })()), "username", [], "any", false, false, false, 68), "html", null, true);
            echo "</b>
            <br>
            Exercice : <b>";
            // line 70
            echo twig_escape_filter($this->env, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 70, $this->source); })()), "html", null, true);
            echo "</b>
        </div>
        <br>
        <p><b>Temps passé total par dossier :</b></p>
        <br>

        <table id=\"list-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
                <tr>
                    <th>Dossier</th>
                    <th>Temps passé total</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 84
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["results2"]) || array_key_exists("results2", $context) ? $context["results2"] : (function () { throw new RuntimeError('Variable "results2" does not exist.', 84, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["Temps"]) {
                // line 85
                echo "                    <tr>
                        <td>";
                // line 86
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "numdos", [], "any", false, false, false, 86), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "dossier", [], "any", false, false, false, 86), "html", null, true);
                echo "</td>
                        <td>";
                // line 87
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Temps"], "tempstotal", [], "any", false, false, false, 87), "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Temps'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 90
            echo "            </tbody>
        </table>
        <br>
        <br>
        <p><b>Détails des temps passés :</b></p>
        <table id=\"list-table-details\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
            <tr>
                <th>Date</th>
                <th>Dossier</th>
                <th>Tâche</th>
                <th>Temps passé</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 105
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["details"]) || array_key_exists("details", $context) ? $context["details"] : (function () { throw new RuntimeError('Variable "details" does not exist.', 105, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["Detail"]) {
                // line 106
                echo "                <tr>
                    <td>";
                // line 107
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Detail"], "date", [], "any", false, false, false, 107), "d/m/Y"), "html", null, true);
                echo "</td>
                    <td>";
                // line 108
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "dossier", [], "any", false, false, false, 108), "numero", [], "any", false, false, false, 108), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "dossier", [], "any", false, false, false, 108), "nom", [], "any", false, false, false, 108), "html", null, true);
                echo "</td>
                    <td>";
                // line 109
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "tache", [], "any", false, false, false, 109), "numero", [], "any", false, false, false, 109), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Detail"], "tache", [], "any", false, false, false, 109), "intitule", [], "any", false, false, false, 109), "html", null, true);
                echo "</td>
                    <td>";
                // line 110
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Detail"], "tempspasse", [], "any", false, false, false, 110), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Detail'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "            </tbody>
        </table>

    ";
        }
        // line 117
        echo "

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "results.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  293 => 117,  287 => 113,  278 => 110,  272 => 109,  266 => 108,  262 => 107,  259 => 106,  255 => 105,  238 => 90,  229 => 87,  223 => 86,  220 => 85,  216 => 84,  199 => 70,  194 => 68,  190 => 66,  187 => 65,  182 => 61,  176 => 57,  167 => 54,  163 => 53,  157 => 52,  153 => 51,  150 => 50,  146 => 49,  129 => 34,  120 => 31,  116 => 30,  112 => 29,  109 => 28,  105 => 27,  88 => 13,  83 => 11,  78 => 9,  74 => 7,  71 => 6,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}

    {# results #}
    {% if results is defined %}

        <div class=\"pageTitle\">
            Numéro du Dossier : <b>{{ dossier.numero }}</b>
            <br>
            Nom du dossier : <b>{{ dossier.nom }}</b>
            <br>
            Exercice : <b>{{ exercice }}</b>
        </div>
        <br>
        <p><b>Temps passé total par tâche :</b></p>
        <br>
        <table id=\"list-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
                <tr>
                    <th>Numéro Tâche</th>
                    <th>Intitulé Tâche</th>
                    <th>Temps passé total</th>
                </tr>
            </thead>
            <tbody>
            {% for Tache in results %}
                <tr>
                    <td>{{ Tache.num }}</td>
                    <td>{{ Tache.intitule }}</td>
                    <td>{{ Tache.tempstotal }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
        <br>
        <br>
        <p><b>Détails des temps passés :</b></p>
        <table id=\"list-table-details\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
            <tr>
                <th>Date</th>
                <th>Intitulé Tâche</th>
                <th>Collaborateur</th>
                <th>Temps passé</th>
            </tr>
            </thead>
            <tbody>
            {% for Detail in details %}
                <tr>
                    <td>{{ Detail.date|date('d/m/Y') }}</td>
                    <td>{{ Detail.tache.numero }} {{ Detail.tache.intitule }}</td>
                    <td>{{ Detail.collaborateur.username }}</td>
                    <td>{{ Detail.tempspasse }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>

    {% endif %}



    {# results2 #}
    {% if results2 is defined %}

        <div class=\"pageTitle\">
            Collaborateur : <b>{{ collaborateur.username }}</b>
            <br>
            Exercice : <b>{{ exercice }}</b>
        </div>
        <br>
        <p><b>Temps passé total par dossier :</b></p>
        <br>

        <table id=\"list-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
                <tr>
                    <th>Dossier</th>
                    <th>Temps passé total</th>
                </tr>
            </thead>
            <tbody>
                {% for Temps in results2 %}
                    <tr>
                        <td>{{ Temps.numdos }} {{ Temps.dossier }}</td>
                        <td>{{ Temps.tempstotal }}</td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
        <br>
        <br>
        <p><b>Détails des temps passés :</b></p>
        <table id=\"list-table-details\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
            <thead>
            <tr>
                <th>Date</th>
                <th>Dossier</th>
                <th>Tâche</th>
                <th>Temps passé</th>
            </tr>
            </thead>
            <tbody>
            {% for Detail in details %}
                <tr>
                    <td>{{ Detail.date|date('d/m/Y') }}</td>
                    <td>{{ Detail.dossier.numero }} {{ Detail.dossier.nom }}</td>
                    <td>{{ Detail.tache.numero }} {{ Detail.tache.intitule }}</td>
                    <td>{{ Detail.tempspasse }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>

    {% endif %}


{% endblock %}", "results.html.twig", "/home/guilhem/Projects/Temporela/tempo/app/Resources/views/results.html.twig");
    }
}
