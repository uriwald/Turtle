<?php

/* TwigBundle:Exception:trace.html.twig */
class __TwigTemplate_6d5039e45cdba787c4632c8f297ca2c1 extends Twig_Template
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
        if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
        if ($this->getAttribute($_trace_, "function")) {
            // line 2
            echo "    at
    <strong>
        <abbr title=\"";
            // line 4
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_trace_, "class"), "html", null, true);
            echo "\">";
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_trace_, "short_class"), "html", null, true);
            echo "</abbr>
        ";
            // line 5
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, ($this->getAttribute($_trace_, "type") . $this->getAttribute($_trace_, "function")), "html", null, true);
            echo "
    </strong>
    (";
            // line 7
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->formatArgs($this->getAttribute($_trace_, "args"));
            echo ")
";
        }
        // line 9
        echo "
";
        // line 10
        if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
        if (((($this->getAttribute($_trace_, "file", array(), "any", true, true) && $this->getAttribute($_trace_, "file")) && $this->getAttribute($_trace_, "line", array(), "any", true, true)) && $this->getAttribute($_trace_, "line"))) {
            // line 11
            echo "    ";
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo (($this->getAttribute($_trace_, "function")) ? ("<br />") : (""));
            echo "
    in ";
            // line 12
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->formatFile($this->getAttribute($_trace_, "file"), $this->getAttribute($_trace_, "line"));
            echo "&nbsp;
    ";
            // line 13
            ob_start();
            // line 14
            echo "    <a href=\"#\" onclick=\"toggle('trace_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "'); switchIcons('icon_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_open', 'icon_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_close'); return false;\">
        <img class=\"toggle\" id=\"icon_";
            // line 15
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_close\" alt=\"-\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("display") : ("hidden"));
            echo "\" />
        <img class=\"toggle\" id=\"icon_";
            // line 16
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_open\" alt=\"+\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("hidden") : ("display"));
            echo "; margin-left: -18px\" />
    </a>
    ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 19
            echo "    <div id=\"trace_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "\" style=\"display: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("block") : ("none"));
            echo "\" class=\"trace\">
        ";
            // line 20
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->fileExcerpt($this->getAttribute($_trace_, "file"), $this->getAttribute($_trace_, "line"));
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 19,  80 => 15,  63 => 13,  58 => 12,  40 => 7,  250 => 96,  240 => 90,  236 => 88,  229 => 84,  225 => 83,  220 => 80,  218 => 79,  215 => 78,  212 => 77,  209 => 76,  200 => 71,  194 => 67,  179 => 61,  176 => 60,  173 => 59,  166 => 55,  162 => 54,  157 => 51,  155 => 50,  151 => 48,  148 => 47,  145 => 46,  139 => 45,  128 => 43,  118 => 36,  114 => 20,  109 => 31,  87 => 28,  84 => 27,  69 => 24,  65 => 14,  34 => 5,  27 => 3,  46 => 9,  29 => 3,  25 => 5,  36 => 6,  32 => 3,  22 => 2,  19 => 1,  94 => 39,  88 => 6,  79 => 26,  48 => 14,  39 => 7,  35 => 7,  31 => 6,  26 => 4,  21 => 1,  203 => 72,  197 => 66,  189 => 62,  183 => 63,  180 => 57,  174 => 56,  170 => 54,  167 => 53,  158 => 48,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 37,  133 => 44,  130 => 35,  124 => 32,  121 => 31,  113 => 30,  108 => 29,  105 => 28,  102 => 27,  99 => 26,  95 => 24,  91 => 16,  81 => 40,  70 => 15,  66 => 13,  62 => 22,  59 => 22,  56 => 10,  52 => 11,  49 => 10,  45 => 7,  41 => 15,  37 => 4,  33 => 9,  30 => 4,);
    }
}
