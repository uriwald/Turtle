<?php

/* TwigBundle:Exception:error.html.twig */
class __TwigTemplate_12308abd7aef3cc58aabb3bd030282c0 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>An Error Occurred: ";
        // line 5
        if (isset($context["status_text"])) { $_status_text_ = $context["status_text"]; } else { $_status_text_ = null; }
        echo twig_escape_filter($this->env, $_status_text_, "html", null, true);
        echo "</title>
    </head>
    <body>
        <h1>Oops! An Error Occurred</h1>
        <h2>The server returned a \"";
        // line 9
        if (isset($context["status_code"])) { $_status_code_ = $context["status_code"]; } else { $_status_code_ = null; }
        echo twig_escape_filter($this->env, $_status_code_, "html", null, true);
        echo " ";
        if (isset($context["status_text"])) { $_status_text_ = $context["status_text"]; } else { $_status_text_ = null; }
        echo twig_escape_filter($this->env, $_status_text_, "html", null, true);
        echo "\".</h2>

        <div>
            Something is broken. Please e-mail us at [email] and let us know
            what you were doing when this error occurred. We will fix it as soon
            as possible. Sorry for any inconvenience caused.
        </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 2,  46 => 7,  29 => 3,  25 => 5,  36 => 6,  32 => 3,  22 => 2,  19 => 1,  94 => 39,  88 => 6,  79 => 39,  48 => 14,  39 => 7,  35 => 7,  31 => 6,  26 => 4,  21 => 1,  203 => 70,  197 => 66,  189 => 62,  183 => 58,  180 => 57,  174 => 56,  170 => 54,  167 => 53,  158 => 48,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 37,  133 => 36,  130 => 35,  124 => 32,  121 => 31,  113 => 30,  108 => 29,  105 => 28,  102 => 27,  99 => 26,  95 => 24,  91 => 22,  81 => 40,  70 => 15,  66 => 13,  62 => 12,  59 => 22,  56 => 10,  52 => 6,  49 => 5,  45 => 7,  41 => 8,  37 => 4,  33 => 9,  30 => 4,);
    }
}
