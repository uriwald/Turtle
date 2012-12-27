<?php

/* DoctrineBundle:Collector:db.html.twig */
class __TwigTemplate_d1c668bcab5416a55035eab42376e7fd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
            'queries' => array($this, 'block_queries'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "isXmlHttpRequest")) ? ("WebProfilerBundle:Profiler:ajax_layout.html.twig") : ("WebProfilerBundle:Profiler:layout.html.twig")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <img width=\"20\" height=\"28\" alt=\"Database\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAYAAABh2p9gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQRJREFUeNpi/P//PwM1ARMDlcGogZQDlpMnT7pxc3NbA9nhQKxOpL5rQLwJiPeBsI6Ozl+YBOOOHTv+AOllQNwtLS39F2owKYZ/gRq8G4i3ggxEToggWzvc3d2Pk+1lNL4fFAs6ODi8JzdS7mMRVyDVoAMHDsANdAPiOCC+jCQvQKqBQB/BDbwBxK5AHA3E/kB8nKJkA8TMQBwLxaBIKQbi70AvTADSBiSadwFXpCikpKQU8PDwkGTaly9fHFigkaKIJid4584dkiMFFI6jkTJII0WVmpHCAixZQEXWYhDeuXMnyLsVlEQKI45qFBQZ8eRECi4DBaAlDqle/8A48ip6gAADANdQY88Uc0oGAAAAAElFTkSuQmCC\"/>
        <span class=\"sf-toolbar-status";
        // line 6
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        if ((50 < $this->getAttribute($_collector_, "querycount"))) {
            echo " sf-toolbar-status-yellow";
        }
        echo "\">";
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
        echo "</span>
        <span class=\"sf-toolbar-info-piece-additional-detail\">in ";
        // line 7
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, sprintf("%0.2f", ($this->getAttribute($_collector_, "time") * 1000)), "html", null, true);
        echo " ms</span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 9
        echo "    ";
        ob_start();
        // line 10
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>DB Queries</b>
            <span>";
        // line 12
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
        echo "</span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <b>Query time</b>
            <span>";
        // line 16
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, sprintf("%0.2f", ($this->getAttribute($_collector_, "time") * 1000)), "html", null, true);
        echo " ms</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 19
        echo "    ";
        if (isset($context["profiler_url"])) { $_profiler_url_ = $context["profiler_url"]; } else { $_profiler_url_ = null; }
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => $_profiler_url_)));
    }

    // line 22
    public function block_menu($context, array $blocks = array())
    {
        // line 23
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/db.png"), "html", null, true);
        echo "\" alt=\"\" /></span>
    <strong>Doctrine</strong>
    <span class=\"count\">
        <span>";
        // line 27
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
        echo "</span>
        <span>";
        // line 28
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, sprintf("%0.0f", ($this->getAttribute($_collector_, "time") * 1000)), "html", null, true);
        echo " ms</span>
    </span>
</span>
";
    }

    // line 33
    public function block_panel($context, array $blocks = array())
    {
        // line 34
        echo "    ";
        if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
        if (("explain" == $_page_)) {
            // line 35
            echo "        ";
            if (isset($context["token"])) { $_token_ = $context["token"]; } else { $_token_ = null; }
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo $this->env->getExtension('actions')->renderAction("DoctrineBundle:Profiler:explain", array("token" => $_token_, "panel" => "db", "connectionName" => $this->getAttribute($this->getAttribute($this->getAttribute($_app_, "request"), "query"), "get", array(0 => "connection"), "method"), "query" => $this->getAttribute($this->getAttribute($this->getAttribute($_app_, "request"), "query"), "get", array(0 => "query"), "method")), array());
            // line 41
            echo "    ";
        } else {
            // line 42
            echo "        ";
            $this->displayBlock("queries", $context, $blocks);
            echo "
    ";
        }
    }

    // line 46
    public function block_queries($context, array $blocks = array())
    {
        // line 47
        echo "    <h2>Queries</h2>

    ";
        // line 49
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_collector_, "queries"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["connection"] => $context["queries"]) {
            // line 50
            echo "        <h3>Connection <em>";
            if (isset($context["connection"])) { $_connection_ = $context["connection"]; } else { $_connection_ = null; }
            echo twig_escape_filter($this->env, $_connection_, "html", null, true);
            echo "</em></h3>
        ";
            // line 51
            if (isset($context["queries"])) { $_queries_ = $context["queries"]; } else { $_queries_ = null; }
            if (twig_test_empty($_queries_)) {
                // line 52
                echo "            <p>
                <em>No queries.</em>
            </p>
        ";
            } else {
                // line 56
                echo "            <ul class=\"alt\">
                ";
                // line 57
                if (isset($context["queries"])) { $_queries_ = $context["queries"]; } else { $_queries_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($_queries_);
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["i"] => $context["query"]) {
                    // line 58
                    echo "                    <li class=\"";
                    if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                    echo twig_escape_filter($this->env, twig_cycle(array(0 => "odd", 1 => "even"), $_i_), "html", null, true);
                    echo "\">
                        <div>
                            ";
                    // line 60
                    if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                    if ($this->getAttribute($_query_, "explainable")) {
                        // line 61
                        echo "                            <a href=\"";
                        if (isset($context["token"])) { $_token_ = $context["token"]; } else { $_token_ = null; }
                        if (isset($context["connection"])) { $_connection_ = $context["connection"]; } else { $_connection_ = null; }
                        if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("panel" => "db", "token" => $_token_, "page" => "explain", "connection" => $_connection_, "query" => $_i_)), "html", null, true);
                        echo "\" onclick=\"return explain(this);\" style=\"text-decoration: none;\" title=\"Explains\" data-target-id=\"explain-";
                        if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                        echo twig_escape_filter($this->env, $_i_, "html", null, true);
                        echo "-";
                        if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_loop_, "parent"), "loop"), "index"), "html", null, true);
                        echo "\" >
                                <img alt=\"+\" src=\"";
                        // line 62
                        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
                        echo "\" style=\"display: inline;\" />
                                <img alt=\"-\" src=\"";
                        // line 63
                        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
                        echo "\" style=\"display: none;\" />
                            </a>
                            ";
                    }
                    // line 66
                    echo "                            <code>";
                    if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                    echo twig_escape_filter($this->env, $this->getAttribute($_query_, "sql"), "html", null, true);
                    echo "</code>
                        </div>
                        <small>
                            <strong>Parameters</strong>: ";
                    // line 69
                    if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                    echo twig_escape_filter($this->env, $this->env->getExtension('yaml')->encode($this->getAttribute($_query_, "params")), "html", null, true);
                    echo "<br />
                            <strong>Time</strong>: ";
                    // line 70
                    if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                    echo twig_escape_filter($this->env, sprintf("%0.2f", ($this->getAttribute($_query_, "executionMS") * 1000)), "html", null, true);
                    echo " ms
                        </small>
                        ";
                    // line 72
                    if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                    if ($this->getAttribute($_query_, "explainable")) {
                        // line 73
                        echo "                        <div id=\"explain-";
                        if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                        echo twig_escape_filter($this->env, $_i_, "html", null, true);
                        echo "-";
                        if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_loop_, "parent"), "loop"), "index"), "html", null, true);
                        echo "\" class=\"loading\"></div>
                        ";
                    }
                    // line 75
                    echo "                    </li>
                ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['i'], $context['query'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 77
                echo "            </ul>
        ";
            }
            // line 79
            echo "    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['connection'], $context['queries'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 80
        echo "
    <h2>Database Connections</h2>

    ";
        // line 83
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        if ($this->getAttribute($_collector_, "connections")) {
            // line 84
            echo "        ";
            if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute($_collector_, "connections")));
            // line 85
            echo "    ";
        } else {
            // line 86
            echo "        <p>
            <em>No connections.</em>
        </p>
    ";
        }
        // line 90
        echo "
    <h2>Entity Managers</h2>

    ";
        // line 93
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        if ($this->getAttribute($_collector_, "managers")) {
            // line 94
            echo "        ";
            if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute($_collector_, "managers")));
            // line 95
            echo "    ";
        } else {
            // line 96
            echo "        <p>
            <em>No entity managers.</em>
        </p>
    ";
        }
        // line 100
        echo "
    <script type=\"text/javascript\">//<![CDATA[
        function explain(link) {
            \"use strict\";

            var imgs = link.children,
                target = link.getAttribute('data-target-id');

            Sfjs.toggle(target, imgs[0], imgs[1])
                .load(
                    target,
                    link.href,
                    null,
                    function(xhr, el) {
                        el.innerHTML = 'An error occurred while loading the details';
                        Sfjs.removeClass(el, 'loading');
                    }
                );

            return false;
        }
    //]]></script>
";
    }

    public function getTemplateName()
    {
        return "DoctrineBundle:Collector:db.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  333 => 100,  327 => 96,  324 => 95,  320 => 94,  317 => 93,  312 => 90,  306 => 86,  303 => 85,  299 => 84,  296 => 83,  291 => 80,  277 => 79,  273 => 77,  258 => 75,  248 => 73,  245 => 72,  239 => 70,  234 => 69,  226 => 66,  216 => 62,  202 => 61,  199 => 60,  192 => 58,  171 => 56,  165 => 52,  156 => 50,  138 => 49,  134 => 47,  131 => 46,  123 => 42,  115 => 35,  82 => 22,  76 => 19,  61 => 12,  54 => 9,  141 => 45,  126 => 42,  120 => 41,  111 => 34,  101 => 33,  86 => 25,  83 => 24,  75 => 20,  71 => 19,  64 => 16,  43 => 7,  125 => 24,  110 => 20,  97 => 18,  92 => 28,  89 => 16,  85 => 23,  28 => 4,  57 => 10,  47 => 7,  38 => 6,  24 => 4,  50 => 7,  104 => 34,  80 => 23,  63 => 13,  58 => 12,  40 => 6,  250 => 96,  240 => 90,  236 => 88,  229 => 84,  225 => 83,  220 => 63,  218 => 79,  215 => 78,  212 => 77,  209 => 76,  200 => 71,  194 => 67,  179 => 61,  176 => 60,  173 => 59,  166 => 55,  162 => 51,  157 => 51,  155 => 50,  151 => 47,  148 => 47,  145 => 46,  139 => 45,  128 => 43,  118 => 22,  114 => 37,  109 => 31,  87 => 28,  84 => 27,  69 => 16,  65 => 14,  34 => 5,  27 => 3,  46 => 9,  29 => 3,  25 => 3,  36 => 6,  32 => 4,  22 => 2,  19 => 1,  94 => 27,  88 => 24,  79 => 26,  48 => 7,  39 => 7,  35 => 5,  31 => 6,  26 => 4,  21 => 1,  203 => 72,  197 => 66,  189 => 62,  183 => 63,  180 => 57,  174 => 57,  170 => 54,  167 => 53,  158 => 51,  153 => 45,  150 => 44,  147 => 43,  144 => 42,  136 => 44,  133 => 44,  130 => 35,  124 => 32,  121 => 31,  113 => 21,  108 => 33,  105 => 19,  102 => 27,  99 => 28,  95 => 24,  91 => 16,  81 => 12,  70 => 15,  66 => 13,  62 => 22,  59 => 8,  56 => 12,  52 => 10,  49 => 9,  45 => 6,  41 => 15,  37 => 5,  33 => 4,  30 => 3,);
    }
}
