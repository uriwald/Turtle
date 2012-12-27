<?php

/* ::base.html.twig */
class __TwigTemplate_3cd38297ef148813993c6875f8453713 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 5,  44 => 11,  42 => 10,  23 => 1,  51 => 13,  333 => 100,  327 => 96,  324 => 95,  320 => 94,  317 => 93,  312 => 90,  306 => 86,  303 => 85,  299 => 84,  296 => 83,  291 => 80,  277 => 79,  273 => 77,  258 => 75,  248 => 73,  245 => 72,  239 => 70,  234 => 69,  226 => 66,  216 => 62,  202 => 61,  199 => 60,  192 => 58,  171 => 56,  165 => 52,  156 => 50,  138 => 49,  134 => 47,  131 => 46,  123 => 42,  115 => 35,  82 => 22,  76 => 19,  61 => 12,  54 => 14,  141 => 45,  126 => 42,  120 => 41,  111 => 34,  101 => 33,  86 => 25,  83 => 24,  75 => 20,  71 => 19,  64 => 10,  43 => 7,  125 => 24,  110 => 20,  97 => 18,  92 => 28,  89 => 16,  85 => 23,  28 => 4,  57 => 10,  47 => 12,  38 => 6,  24 => 4,  50 => 7,  104 => 34,  80 => 23,  63 => 13,  58 => 12,  40 => 6,  250 => 96,  240 => 90,  236 => 88,  229 => 84,  225 => 83,  220 => 63,  218 => 79,  215 => 78,  212 => 77,  209 => 76,  200 => 71,  194 => 67,  179 => 61,  176 => 60,  173 => 59,  166 => 55,  162 => 51,  157 => 51,  155 => 50,  151 => 47,  148 => 47,  145 => 46,  139 => 45,  128 => 43,  118 => 22,  114 => 37,  109 => 31,  87 => 28,  84 => 27,  69 => 11,  65 => 14,  34 => 5,  27 => 3,  46 => 12,  29 => 5,  25 => 3,  36 => 6,  32 => 4,  22 => 2,  19 => 1,  94 => 27,  88 => 24,  79 => 26,  48 => 7,  39 => 7,  35 => 7,  31 => 7,  26 => 6,  21 => 1,  203 => 72,  197 => 66,  189 => 62,  183 => 63,  180 => 57,  174 => 57,  170 => 54,  167 => 53,  158 => 51,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 44,  133 => 44,  130 => 35,  124 => 32,  121 => 31,  113 => 21,  108 => 33,  105 => 19,  102 => 27,  99 => 28,  95 => 24,  91 => 16,  81 => 12,  70 => 15,  66 => 13,  62 => 22,  59 => 6,  56 => 12,  52 => 10,  49 => 9,  45 => 6,  41 => 9,  37 => 5,  33 => 6,  30 => 3,);
    }
}
