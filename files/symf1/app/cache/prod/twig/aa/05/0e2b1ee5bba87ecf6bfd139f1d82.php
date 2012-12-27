<?php

/* TwigBundle:Exception:exception.xml.twig */
class __TwigTemplate_aa050e2b1ee5bba87ecf6bfd139f1d82 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?xml version=\"1.0\" encoding=\"";
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\" ?>

<error code=\"";
        // line 3
        if (isset($context["status_code"])) { $_status_code_ = $context["status_code"]; } else { $_status_code_ = null; }
        echo twig_escape_filter($this->env, $_status_code_, "html", null, true);
        echo "\" message=\"";
        if (isset($context["status_text"])) { $_status_text_ = $context["status_text"]; } else { $_status_text_ = null; }
        echo twig_escape_filter($this->env, $_status_text_, "html", null, true);
        echo "\">
";
        // line 4
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_exception_, "toarray"));
        foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
            // line 5
            echo "    <exception class=\"";
            if (isset($context["e"])) { $_e_ = $context["e"]; } else { $_e_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_e_, "class"), "html", null, true);
            echo "\" message=\"";
            if (isset($context["e"])) { $_e_ = $context["e"]; } else { $_e_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_e_, "message"), "html", null, true);
            echo "\">
";
            // line 6
            if (isset($context["e"])) { $_e_ = $context["e"]; } else { $_e_ = null; }
            $this->env->loadTemplate("TwigBundle:Exception:traces.xml.twig")->display(array("exception" => $_e_));
            // line 7
            echo "    </exception>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 9
        echo "</error>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 9,  47 => 6,  38 => 5,  24 => 4,  50 => 7,  104 => 19,  80 => 15,  63 => 13,  58 => 12,  40 => 7,  250 => 96,  240 => 90,  236 => 88,  229 => 84,  225 => 83,  220 => 80,  218 => 79,  215 => 78,  212 => 77,  209 => 76,  200 => 71,  194 => 67,  179 => 61,  176 => 60,  173 => 59,  166 => 55,  162 => 54,  157 => 51,  155 => 50,  151 => 48,  148 => 47,  145 => 46,  139 => 45,  128 => 43,  118 => 36,  114 => 20,  109 => 31,  87 => 28,  84 => 27,  69 => 24,  65 => 14,  34 => 5,  27 => 3,  46 => 9,  29 => 3,  25 => 3,  36 => 6,  32 => 3,  22 => 2,  19 => 1,  94 => 39,  88 => 6,  79 => 26,  48 => 14,  39 => 7,  35 => 7,  31 => 6,  26 => 4,  21 => 1,  203 => 72,  197 => 66,  189 => 62,  183 => 63,  180 => 57,  174 => 56,  170 => 54,  167 => 53,  158 => 48,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 37,  133 => 44,  130 => 35,  124 => 32,  121 => 31,  113 => 30,  108 => 29,  105 => 28,  102 => 27,  99 => 26,  95 => 24,  91 => 16,  81 => 40,  70 => 15,  66 => 13,  62 => 22,  59 => 22,  56 => 10,  52 => 11,  49 => 10,  45 => 7,  41 => 15,  37 => 4,  33 => 4,  30 => 4,);
    }
}
