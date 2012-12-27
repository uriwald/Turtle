<?php

/* DoctrineBundle:Collector:explain.html.twig */
class __TwigTemplate_84e9c8886f67b93179002f8a3144feca extends Twig_Template
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
        echo "<small><strong>Explanation</strong>:</small>

<table style=\"margin: 5px 0;\">
    <thead>
        <tr>
            ";
        // line 6
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($this->getAttribute($_data_, 0, array(), "array")));
        foreach ($context['_seq'] as $context["_key"] => $context["label"]) {
            // line 7
            echo "                <th>";
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            echo twig_escape_filter($this->env, $_label_, "html", null, true);
            echo "</th>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['label'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 9
        echo "        </tr>
    </thead>
    <tbody>
        ";
        // line 12
        if (isset($context["data"])) { $_data_ = $context["data"]; } else { $_data_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_data_);
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 13
            echo "        <tr>
            ";
            // line 14
            if (isset($context["row"])) { $_row_ = $context["row"]; } else { $_row_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_row_);
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 15
                echo "                <td>";
                if (isset($context["item"])) { $_item_ = $context["item"]; } else { $_item_ = null; }
                echo twig_escape_filter($this->env, $_item_, "html", null, true);
                echo "</td>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 17
            echo "        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 19
        echo "    </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "DoctrineBundle:Collector:explain.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 13,  333 => 100,  327 => 96,  324 => 95,  320 => 94,  317 => 93,  312 => 90,  306 => 86,  303 => 85,  299 => 84,  296 => 83,  291 => 80,  277 => 79,  273 => 77,  258 => 75,  248 => 73,  245 => 72,  239 => 70,  234 => 69,  226 => 66,  216 => 62,  202 => 61,  199 => 60,  192 => 58,  171 => 56,  165 => 52,  156 => 50,  138 => 49,  134 => 47,  131 => 46,  123 => 42,  115 => 35,  82 => 22,  76 => 19,  61 => 12,  54 => 14,  141 => 45,  126 => 42,  120 => 41,  111 => 34,  101 => 33,  86 => 25,  83 => 24,  75 => 20,  71 => 19,  64 => 16,  43 => 7,  125 => 24,  110 => 20,  97 => 18,  92 => 28,  89 => 16,  85 => 23,  28 => 4,  57 => 10,  47 => 7,  38 => 6,  24 => 4,  50 => 7,  104 => 34,  80 => 23,  63 => 13,  58 => 12,  40 => 6,  250 => 96,  240 => 90,  236 => 88,  229 => 84,  225 => 83,  220 => 63,  218 => 79,  215 => 78,  212 => 77,  209 => 76,  200 => 71,  194 => 67,  179 => 61,  176 => 60,  173 => 59,  166 => 55,  162 => 51,  157 => 51,  155 => 50,  151 => 47,  148 => 47,  145 => 46,  139 => 45,  128 => 43,  118 => 22,  114 => 37,  109 => 31,  87 => 28,  84 => 27,  69 => 17,  65 => 14,  34 => 5,  27 => 3,  46 => 12,  29 => 3,  25 => 3,  36 => 6,  32 => 4,  22 => 2,  19 => 1,  94 => 27,  88 => 24,  79 => 26,  48 => 7,  39 => 7,  35 => 5,  31 => 7,  26 => 6,  21 => 1,  203 => 72,  197 => 66,  189 => 62,  183 => 63,  180 => 57,  174 => 57,  170 => 54,  167 => 53,  158 => 51,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 44,  133 => 44,  130 => 35,  124 => 32,  121 => 31,  113 => 21,  108 => 33,  105 => 19,  102 => 27,  99 => 28,  95 => 24,  91 => 16,  81 => 12,  70 => 15,  66 => 13,  62 => 22,  59 => 15,  56 => 12,  52 => 10,  49 => 9,  45 => 6,  41 => 9,  37 => 5,  33 => 4,  30 => 3,);
    }
}
