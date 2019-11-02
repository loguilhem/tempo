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

/* lists/tache.html.twig */
class __TwigTemplate_cba2c46aefdfa49845c057c71b4bcbb140e41f38428824b928e810dee8fe85eb extends \Twig\Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lists/tache.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lists/tache.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "lists/tache.html.twig", 1);
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
        Liste des Tâches Temporela
    </div>
    
    <a href=\"";
        // line 9
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("addtache");
        echo "\"><input type=\"button\" value=\"+\"></a>
     
        
    <table id=\"listTache-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Numéro</th>
                <th>Tâche mère</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Voir temps passé</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listTache"]) || array_key_exists("listTache", $context) ? $context["listTache"] : (function () { throw new RuntimeError('Variable "listTache" does not exist.', 24, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["Tache"]) {
            // line 25
            echo "        <tr>
            <td>";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Tache"], "intitule", [], "any", false, false, false, 26), "html", null, true);
            echo "</td>
            <td>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["Tache"], "numero", [], "any", false, false, false, 27), "html", null, true);
            echo "</td>
            <td>
            ";
            // line 29
            if ((twig_get_attribute($this->env, $this->source, $context["Tache"], "tachemere", [], "any", false, false, false, 29) != null)) {
                // line 30
                echo "                ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["Tache"], "tachemere", [], "any", false, false, false, 30), "intitule", [], "any", false, false, false, 30), "html", null, true);
                echo "
            ";
            }
            // line 32
            echo "            <td><a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("modtache", ["id" => twig_get_attribute($this->env, $this->source, $context["Tache"], "id", [], "any", false, false, false, 32)]), "html", null, true);
            echo "\">Modifier</a></td>
            <td><a class=\"confirmation\" href=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("deltache", ["id" => twig_get_attribute($this->env, $this->source, $context["Tache"], "id", [], "any", false, false, false, 33)]), "html", null, true);
            echo "\">Supprimer</a></td>
            <td>X</td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Tache'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "        </tbody>
    
    </table>            
            
                 
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "lists/tache.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 37,  122 => 33,  117 => 32,  111 => 30,  109 => 29,  104 => 27,  100 => 26,  97 => 25,  93 => 24,  75 => 9,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}

    <div class=\"pageTitle\">
        Liste des Tâches Temporela
    </div>
    
    <a href=\"{{ path('addtache') }}\"><input type=\"button\" value=\"+\"></a>
     
        
    <table id=\"listTache-table\" cellspacing=\"0\" width=\"100%\" class=\"display list_table\">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Numéro</th>
                <th>Tâche mère</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                <th>Voir temps passé</th>
            </tr>
        </thead>
        <tbody>
        {% for Tache in listTache %}
        <tr>
            <td>{{ Tache.intitule }}</td>
            <td>{{ Tache.numero }}</td>
            <td>
            {% if Tache.tachemere != null %}
                {{ Tache.tachemere.intitule }}
            {% endif %}
            <td><a href=\"{{ path('modtache', {'id':Tache.id}) }}\">Modifier</a></td>
            <td><a class=\"confirmation\" href=\"{{ path('deltache', {'id':Tache.id}) }}\">Supprimer</a></td>
            <td>X</td>
        </tr>
        {% endfor %}
        </tbody>
    
    </table>            
            
                 
{% endblock %}
    ", "lists/tache.html.twig", "/home/guilhem/Projects/Temporela/tempo/app/Resources/views/lists/tache.html.twig");
    }
}
