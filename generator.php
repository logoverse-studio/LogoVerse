<?php

include "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = "";
$business = "";
$industry = "";
$style = "";
$color = "";
$generated = false;

function resolveBrandColor($value): string
{
    $value = trim(strtolower($value));

    $colors = [
        "blue" => "#2563eb",
        "navy" => "#1e3a8a",
        "purple" => "#7c3aed",
        "violet" => "#7c3aed",
        "pink" => "#db2777",
        "red" => "#dc2626",
        "green" => "#16a34a",
        "teal" => "#0f766e",
        "cyan" => "#0891b2",
        "orange" => "#ea580c",
        "yellow" => "#ca8a04",
        "gold" => "#b8860b",
        "black" => "#111827",
        "white" => "#f8fafc",
        "brown" => "#8b5e34",
        "beige" => "#c8a97e",
        "gray" => "#475569",
        "grey" => "#475569",
    ];

    if (isset($colors[$value])) {
        return $colors[$value];
    }

    if (preg_match('/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value)) {
        return $value;
    }

    return "#2563eb";
}

function escapeSvgText(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function brandInitial(string $business): string
{
    $business = trim($business);
    if ($business === '') {
        return 'L';
    }

    $words = preg_split('/\s+/', $business);
    $initials = '';

    foreach ($words as $word) {
        if ($word !== '') {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        if (strlen($initials) >= 2) {
            break;
        }
    }

    return $initials !== '' ? $initials : 'L';
}

function industryType(string $industry): string
{
    $industry = strtolower($industry);

    if (preg_match('/coffee|cafe|cafeteria|bakery|restaurant|food|bar|tea/', $industry)) {
        return 'cafe';
    }
    if (preg_match('/shoe|shoes|footwear|sneaker|sneakers/', $industry)) {
    return 'footwear';
    }
    if (preg_match('/animal|animals|pet|pets|dog|dogs|cat|cats|paw|paws/', $industry)) {
    return 'animals';
    }
    if (preg_match('/makeup|cosmetics|cosmetic|lipstick|beauty products|makeup artist/', $industry)) {
    return 'makeup';
    }
    if (preg_match('/flower|flowers|floral|florist|plant|plants/', $industry)) {
    return 'flowers';
    }
    if (preg_match('/fashion|clothing|apparel|boutique|beauty|salon/', $industry)) {
        return 'fashion';
    }
    if (preg_match('/computer|computers|laptop|laptops|pc|desktop|monitor|electronics/', $industry)) {
    return 'computer';
    }
    if (preg_match('/technology|software|it|tech|app|ai|digital|cyber/', $industry)) {
        return 'tech';
    }
    if (preg_match('/fitness|gym|health|yoga|wellness/', $industry)) {
        return 'wellness';
    }

    return 'brand';
}

function generateLogoSvg(string $business, string $industry, string $color, string $style): string
{
    $primary = resolveBrandColor($color);
    $businessEsc = escapeSvgText($business);
    $industryEsc = escapeSvgText($industry);
    $initials = escapeSvgText(brandInitial($business));
    $type = industryType($industry);

    // Professional vector treatment. The mark uses SVG paths instead of a simple
    // circle/rectangle-only construction. The visual symbol adapts to the industry.
    switch ($type) {
        case 'cafe':
            $mark = "
                <path d='M72 86h82l-7 42c-2 13-13 22-26 22H105c-13 0-24-9-26-22z' fill='{$primary}'/>
                <path d='M154 96h16c14 0 25 11 25 25s-11 25-25 25h-14' fill='none' stroke='{$primary}' stroke-width='10' stroke-linecap='round'/>
                <path d='M89 72c-8-10-2-19 4-27 7-9 10-17 3-27' fill='none' stroke='{$primary}' stroke-width='6' stroke-linecap='round'/>
                <path d='M112 72c-8-10-2-19 4-27 7-9 10-17 3-27' fill='none' stroke='{$primary}' stroke-width='6' stroke-linecap='round'/>
                <path d='M135 72c-8-10-2-19 4-27 7-9 10-17 3-27' fill='none' stroke='{$primary}' stroke-width='6' stroke-linecap='round'/>
                <path d='M65 155h116' stroke='#111827' stroke-width='7' stroke-linecap='round'/>
            ";
            break;
        case 'footwear':
    $mark = "
        <path d='M58 118
                 C74 112 87 100 99 83
                 L116 60
                 C122 52 133 50 142 55
                 L166 70
                 C175 76 181 87 185 99
                 L191 116
                 C193 122 189 128 183 130
                 L158 136
                 C143 140 129 142 113 142
                 H75
                 C65 142 58 136 55 129
                 C53 124 54 121 58 118 Z'
              fill='{$primary}'
              opacity='.16'
              stroke='{$primary}'
              stroke-width='6'
              stroke-linejoin='round'/>

        <path d='M58 122
                 C78 128 100 130 122 129
                 C145 128 167 122 188 116'
              fill='none'
              stroke='#111827'
              stroke-width='6'
              stroke-linecap='round'/>

        <path d='M101 84
                 C111 91 122 97 135 99
                 C146 101 156 104 166 110'
              fill='none'
              stroke='{$primary}'
              stroke-width='5'
              stroke-linecap='round'/>

        <path d='M115 69
                 L130 82
                 M108 77
                 L124 90
                 M102 85
                 L118 98'
              fill='none'
              stroke='#111827'
              stroke-width='4'
              stroke-linecap='round'/>

        <path d='M69 118
                 C78 112 85 105 91 96'
              fill='none'
              stroke='#111827'
              stroke-width='5'
              stroke-linecap='round'/>

        <path d='M77 136
                 H177'
              fill='none'
              stroke='{$primary}'
              stroke-width='6'
              stroke-linecap='round'/>
    ";
    break;
        case 'animals':
    $mark = "
        <circle cx='82' cy='78' r='12'
                fill='{$primary}' opacity='.18'
                stroke='{$primary}' stroke-width='5'/>

        <circle cx='108' cy='66' r='12'
                fill='{$primary}' opacity='.18'
                stroke='{$primary}' stroke-width='5'/>

        <circle cx='141' cy='66' r='12'
                fill='{$primary}' opacity='.18'
                stroke='{$primary}' stroke-width='5'/>

        <circle cx='167' cy='78' r='12'
                fill='{$primary}' opacity='.18'
                stroke='{$primary}' stroke-width='5'/>

        <path d='M86 119
                 C86 98 101 84 124 84
                 C147 84 162 98 162 119
                 C162 143 146 158 124 158
                 C102 158 86 143 86 119 Z'
              fill='{$primary}' opacity='.16'
              stroke='{$primary}' stroke-width='6'
              stroke-linejoin='round'/>

        <path d='M106 116
                 C114 108 134 108 142 116'
              fill='none'
              stroke='#111827'
              stroke-width='5'
              stroke-linecap='round'/>
    ";
    break;
            case 'makeup':
            $mark = "
                <!-- Compact -->
                <circle cx='108' cy='113' r='40'
                        fill='{$primary}'
                        opacity='.13'
                        stroke='{$primary}'
                        stroke-width='6'/>

                <circle cx='108' cy='113' r='27'
                        fill='#ffffff'
                        stroke='{$primary}'
                        stroke-width='4'/>

                <circle cx='108' cy='113' r='17'
                        fill='{$primary}'
                        opacity='.10'/>

                <!-- Makeup brush -->
                <path d='M143 79 L171 51'
                      stroke='#111827'
                      stroke-width='7'
                      stroke-linecap='round'/>

                <path d='M138 84 L146 92'
                      stroke='{$primary}'
                      stroke-width='7'
                      stroke-linecap='round'/>

                <path d='M168 48
                         C174 43 182 46 184 52
                         C186 58 181 64 175 63
                         L165 58 Z'
                      fill='{$primary}'
                      opacity='.22'
                      stroke='{$primary}'
                      stroke-width='5'
                      stroke-linejoin='round'/>

                <!-- Small beauty sparkle -->
                <path d='M68 70
                         L71 79
                         L80 82
                         L71 85
                         L68 94
                         L65 85
                         L56 82
                         L65 79 Z'
                      fill='{$primary}'/>

                <circle cx='165' cy='137' r='6'
                        fill='{$primary}'/>

                <!-- Base -->
                <path d='M67 160 H150'
                      stroke='#111827'
                      stroke-width='6'
                      stroke-linecap='round'/>
            ";
            break;  
                    case 'flowers':
            $mark = "
                <!-- Flower petals -->
                <circle cx='120' cy='108' r='18'
                        fill='{$primary}'
                        opacity='.18'
                        stroke='{$primary}'
                        stroke-width='4'/>

                <ellipse cx='120' cy='72' rx='18' ry='26'
                         fill='{$primary}'
                         opacity='.16'
                         stroke='{$primary}'
                         stroke-width='5'/>

                <ellipse cx='88' cy='92' rx='18' ry='26'
                         transform='rotate(-55 88 92)'
                         fill='{$primary}'
                         opacity='.16'
                         stroke='{$primary}'
                         stroke-width='5'/>

                <ellipse cx='152' cy='92' rx='18' ry='26'
                         transform='rotate(55 152 92)'
                         fill='{$primary}'
                         opacity='.16'
                         stroke='{$primary}'
                         stroke-width='5'/>

                <ellipse cx='98' cy='130' rx='18' ry='26'
                         transform='rotate(-115 98 130)'
                         fill='{$primary}'
                         opacity='.16'
                         stroke='{$primary}'
                         stroke-width='5'/>

                <ellipse cx='142' cy='130' rx='18' ry='26'
                         transform='rotate(115 142 130)'
                         fill='{$primary}'
                         opacity='.16'
                         stroke='{$primary}'
                         stroke-width='5'/>

                <!-- Center -->
                <circle cx='120' cy='108' r='11'
                        fill='{$primary}'
                        stroke='#111827'
                        stroke-width='4'/>

                <!-- Stem -->
                <path d='M120 120 V170'
                      stroke='#111827'
                      stroke-width='6'
                      stroke-linecap='round'/>

                <!-- Leaves -->
                <path d='M120 146
                         C103 139 91 143 84 155
                         C101 160 113 157 120 146 Z'
                      fill='{$primary}'
                      opacity='.18'
                      stroke='{$primary}'
                      stroke-width='4'/>

                <path d='M120 150
                         C137 143 149 147 156 159
                         C139 164 127 161 120 150 Z'
                      fill='{$primary}'
                      opacity='.18'
                      stroke='{$primary}'
                      stroke-width='4'/>

                <path d='M70 174 H170'
                      stroke='#111827'
                      stroke-width='6'
                      stroke-linecap='round'/>
            ";
            break;                 
        case 'fashion':
            $mark = "
                <path d='M92 57c8 8 18 12 28 12s20-4 28-12l20 17-16 18v43H88V92L72 74z' fill='{$primary}' opacity='.18' stroke='{$primary}' stroke-width='5' stroke-linejoin='round'/>
                <path d='M103 48c3 11 9 17 17 21 8-4 14-10 17-21' fill='none' stroke='{$primary}' stroke-width='7' stroke-linecap='round'/>
                <path d='M82 93l-18-19' stroke='{$primary}' stroke-width='7' stroke-linecap='round'/>
                <path d='M158 93l18-19' stroke='{$primary}' stroke-width='7' stroke-linecap='round'/>
                <path d='M100 91v46M140 91v46' stroke='#111827' stroke-width='5' stroke-linecap='round'/>
            ";
            break;
                case 'computer':
            $mark = "
                <rect x='56' y='62' width='128' height='88' rx='10'
                      fill='{$primary}'
                      opacity='.14'
                      stroke='{$primary}'
                      stroke-width='6'/>

                <rect x='68' y='74' width='104' height='62' rx='5'
                      fill='#ffffff'
                      stroke='{$primary}'
                      stroke-width='4'/>

                <circle cx='120' cy='105' r='8'
                        fill='{$primary}'/>

                <path d='M101 150h38'
                      stroke='#111827'
                      stroke-width='6'
                      stroke-linecap='round'/>

                <path d='M92 164h56'
                      stroke='{$primary}'
                      stroke-width='7'
                      stroke-linecap='round'/>

                <path d='M99 164l-6 8h54l-6-8'
                      fill='none'
                      stroke='#111827'
                      stroke-width='4'
                      stroke-linejoin='round'/>
            ";
            break;    

        case 'tech':
            $mark = "
                <path d='M120 44l39 18v35c0 27-16 47-39 58-23-11-39-31-39-58V62z' fill='{$primary}' opacity='.16' stroke='{$primary}' stroke-width='6' stroke-linejoin='round'/>
                <path d='M101 92h38M120 75v34M108 102l-10 10M132 102l10 10' stroke='{$primary}' stroke-width='6' stroke-linecap='round'/>
                <circle cx='120' cy='75' r='6' fill='{$primary}'/>
            ";
            break;

        case 'wellness':
            $mark = "
                <path d='M120 143c-38-7-52-37-43-70 34 5 53 25 43 70z' fill='{$primary}' opacity='.18' stroke='{$primary}' stroke-width='6'/>
                <path d='M120 143c38-7 52-37 43-70-34 5-53 25-43 70z' fill='{$primary}' opacity='.10' stroke='{$primary}' stroke-width='6'/>
                <path d='M120 142V73' stroke='#111827' stroke-width='5' stroke-linecap='round'/>
            ";
            break;

        default:
            $mark = "
                <path d='M78 125c13-33 35-53 67-60 0 30-8 52-27 66-14 10-27 13-40 12z' fill='{$primary}' opacity='.16' stroke='{$primary}' stroke-width='6' stroke-linejoin='round'/>
                <path d='M82 142c18-28 39-46 63-57' fill='none' stroke='{$primary}' stroke-width='6' stroke-linecap='round'/>
            ";
            break;
    }

    $subtitle = $style !== '' ? $style . ' • ' . $industry : $industry;

    return "<?xml version='1.0' encoding='UTF-8'?>
<svg xmlns='http://www.w3.org/2000/svg' width='1200' height='820' viewBox='0 0 1200 820' role='img' aria-label='Logo concept for {$businessEsc}'>
    <defs>
        <linearGradient id='bg' x1='0' y1='0' x2='1' y2='1'>
            <stop offset='0%' stop-color='#ffffff'/>
            <stop offset='100%' stop-color='#eef2ff'/>
        </linearGradient>
        <linearGradient id='accent' x1='0' y1='0' x2='1' y2='1'>
            <stop offset='0%' stop-color='{$primary}'/>
            <stop offset='100%' stop-color='#111827'/>
        </linearGradient>
        <filter id='shadow' x='-20%' y='-20%' width='140%' height='140%'>
            <feDropShadow dx='0' dy='18' stdDeviation='20' flood-color='#111827' flood-opacity='.12'/>
        </filter>
    </defs>

    <rect width='1200' height='820' rx='42' fill='url(#bg)'/>
    <path d='M110 110h980' stroke='#e2e8f0' stroke-width='2'/>

    <g filter='url(#shadow)'>
        <path d='M450 150h300c32 0 58 26 58 58v250c0 32-26 58-58 58H450c-32 0-58-26-58-58V208c0-32 26-58 58-58z' fill='#ffffff'/>
    </g>

    <g transform='translate(480 225)'>
        <path d='M60 0h120c10 0 18 8 18 18v190c0 10-8 18-18 18H60c-10 0-18-8-18-18V18C42 8 50 0 60 0z' fill='#f8fafc'/>
        <path d='M96 24h48' stroke='#cbd5e1' stroke-width='6' stroke-linecap='round'/>
        <g transform='translate(0 25)'>
            {$mark}
        </g>
        <text x='120' y='265' text-anchor='middle' font-family='Arial, Helvetica, sans-serif' font-size='34' font-weight='700' fill='#111827'>{$initials}</text>
    </g>

    <text x='600' y='575' text-anchor='middle' font-family='Arial, Helvetica, sans-serif' font-size='58' font-weight='700' fill='#111827'>{$businessEsc}</text>
    <text x='600' y='625' text-anchor='middle' font-family='Arial, Helvetica, sans-serif' font-size='24' font-weight='500' fill='#64748b'>{$subtitle}</text>
    <path d='M520 660h160' stroke='url(#accent)' stroke-width='8' stroke-linecap='round'/>
    <text x='600' y='710' text-anchor='middle' font-family='Arial, Helvetica, sans-serif' font-size='18' font-weight='600' letter-spacing='3' fill='#94a3b8'>LOGOVERSE • PROFESSIONAL VECTOR CONCEPT</text>
</svg>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $business = trim($_POST["business_name"] ?? "");
    $industry = trim($_POST["industry"] ?? "");
    $style = trim($_POST["style"] ?? "");
    $color = trim($_POST["color"] ?? "");
    $generated = true;

    if (isset($_POST["save_project"])) {

        $project_name = $business . " Branding";

        $sql = "INSERT INTO branding_projects
                (user_id, project_name, business_name, industry, style, color_preference, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "isssss",
                $_SESSION["user_id"],
                $project_name,
                $business,
                $industry,
                $style,
                $color
            );

            if ($stmt->execute()) {
                $message = "Project saved successfully!";
            } else {
                $message = "Error saving project: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Unable to prepare project save.";
        }
    }
}

$logoSvg = $generated ? generateLogoSvg($business, $industry, $color, $style) : "";
$logoSvgData = $generated ? base64_encode($logoSvg) : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogoVerse — Professional Branding Generator</title>
    <style>
        :root {
            --brand: #6c63ff;
            --brand-dark: #5048d7;
            --ink: #111827;
            --muted: #64748b;
            --panel: #ffffff;
            --bg: #f5f7ff;
            --line: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, Helvetica, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 10%, rgba(108,99,255,.15), transparent 28%),
                radial-gradient(circle at 90% 20%, rgba(37,99,235,.10), transparent 26%),
                var(--bg);
        }
        header {
            position: sticky;
            top: 0;
            z-index: 20;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px 6vw;
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226,232,240,.85);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            letter-spacing: -.02em;
            font-size: 24px;
        }
        .logo-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            color: #fff;
            background: linear-gradient(135deg, var(--brand), #2563eb);
            box-shadow: 0 12px 28px rgba(108,99,255,.28);
        }
        .back {
            color: var(--ink);
            text-decoration: none;
            font-weight: 700;
            padding: 10px 14px;
            border-radius: 10px;
            background: #fff;
            border: 1px solid var(--line);
        }
        .shell {
            max-width: 1180px;
            margin: 0 auto;
            padding: 42px 22px 80px;
        }
        .intro {
            text-align: center;
            margin-bottom: 28px;
        }
        .eyebrow {
            display: inline-flex;
            padding: 7px 11px;
            border-radius: 999px;
            background: rgba(108,99,255,.10);
            color: var(--brand-dark);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        h1 {
            margin: 13px 0 10px;
            font-size: clamp(32px, 5vw, 54px);
            letter-spacing: -.04em;
        }
        .intro p {
            color: var(--muted);
            max-width: 760px;
            margin: 0 auto;
            line-height: 1.65;
        }
        .grid {
            display: grid;
            grid-template-columns: minmax(320px, 390px) minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }
        .panel {
            background: rgba(255,255,255,.92);
            border: 1px solid rgba(226,232,240,.95);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(15,23,42,.08);
        }
        .form-panel { padding: 28px; }
        .result-panel { padding: 22px; }
        .field { margin-bottom: 17px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 800;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 13px;
            padding: 13px 14px;
            background: #fff;
            color: var(--ink);
            outline: none;
            font-size: 15px;
        }
        input:focus, select:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 4px rgba(108,99,255,.10);
        }
        .primary, .secondary {
            width: 100%;
            border: 0;
            border-radius: 13px;
            padding: 14px 16px;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
        }
        .primary {
            color: white;
            background: linear-gradient(135deg, var(--brand), #2563eb);
            box-shadow: 0 12px 24px rgba(108,99,255,.24);
        }
        .secondary {
            margin-top: 11px;
            color: #fff;
            background: #111827;
        }
        .message {
            margin: 0 0 18px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #ecfdf5;
            color: #047857;
            font-weight: 700;
        }
        .empty {
            min-height: 520px;
            display: grid;
            place-items: center;
            text-align: center;
            color: var(--muted);
            padding: 50px;
        }
        .empty-icon {
            width: 84px;
            height: 84px;
            display: grid;
            place-items: center;
            margin: 0 auto 16px;
            border-radius: 24px;
            background: linear-gradient(135deg, #ede9fe, #dbeafe);
            color: var(--brand);
            font-size: 34px;
        }
        .preview {
            overflow: hidden;
            border-radius: 18px;
            border: 1px solid var(--line);
            background: #fff;
            box-shadow: 0 18px 50px rgba(15,23,42,.08);
        }
        .preview img {
            display: block;
            width: 100%;
            height: auto;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }
        .meta {
            padding: 14px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .meta small { display: block; color: var(--muted); margin-bottom: 4px; }
        .meta strong { font-size: 14px; }
        .suggestions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }
        .suggestion {
            padding: 15px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
        }
        .suggestion small { color: var(--muted); display: block; margin-bottom: 5px; }
.logo-palette {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 12px !important;
    margin-top: 12px !important;
    width: 100% !important;
    align-items: center !important;
}

.logo-palette-color {
    display: block !important;
    flex: 0 0 64px !important;
    width: 64px !important;
    min-width: 64px !important;
    max-width: 64px !important;
    height: 64px !important;
    min-height: 64px !important;
    max-height: 64px !important;
    box-sizing: border-box !important;
    border-radius: 14px !important;
    border: 1px solid rgba(15,23,42,.10) !important;
    box-shadow: 0 4px 12px rgba(0,0,0,.10) !important;
} 
        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
            .empty { min-height: 260px; }
        }
        @media (max-width: 620px) {
            header { padding: 15px 18px; }
            .shell { padding: 28px 14px 50px; }
            .meta-grid, .suggestions { grid-template-columns: 1fr; }
        }
    </style>
    <link rel="stylesheet" href="assets/visual.css">
</head>
<body>
<header>
    <div class="logo">
        <span class="logo-mark">L</span>
        <span>LogoVerse</span>
    </div>
    <a class="back" href="dashboard.php">← Dashboard</a>
</header>

<main class="shell">
    <section class="intro">
        <span class="eyebrow">Professional Vector Branding</span>
        <h1>Build a brand that looks ready for the real world.</h1>
        <p>Generate a polished vector logo concept with industry-aware visual cues, brand names, color palette ideas, font pairings, and taglines.</p>
    </section>

    <div class="grid">
        <section class="panel form-panel">
            <?php if ($message !== ""): ?>
                <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="field">
                    <label for="business_name">Business Name</label>
                    <input id="business_name" type="text" name="business_name" placeholder="e.g. Star Cafe" value="<?php echo htmlspecialchars($business); ?>" required>
                </div>

                <div class="field">
                    <label for="industry">Industry</label>
                    <input id="industry" type="text" name="industry" placeholder="e.g. Cafe, Fashion, Technology" value="<?php echo htmlspecialchars($industry); ?>" required>
                </div>

                <div class="field">
                    <label for="style">Preferred Style</label>
                    <select id="style" name="style" required>
                        <option value="">Select Style</option>
                        <?php foreach (["Modern", "Minimal", "Professional", "Creative"] as $option): ?>
                            <option value="<?php echo $option; ?>" <?php echo $style === $option ? "selected" : ""; ?>><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field">
                    <label for="color">Color Preference</label>
                    <input id="color" type="text" name="color" placeholder="e.g. Blue, Brown, Pink or #2563eb" value="<?php echo htmlspecialchars($color); ?>">
                </div>

                <button class="primary" type="submit">✨ Generate Professional Logo</button>

                <?php if ($generated): ?>
                    <button class="secondary" type="submit" name="save_project">💾 Save Project</button>
                <?php endif; ?>
            </form>
        </section>

        <section class="panel result-panel">
            <?php if ($generated): ?>
                <div class="preview">
                    <img id="logoPreview" src="data:image/svg+xml;base64,<?php echo $logoSvgData; ?>" alt="Generated Logo Preview">
                </div>

                <div class="meta-grid">
                    <div class="meta"><small>Business</small><strong><?php echo htmlspecialchars($business); ?></strong></div>
                    <div class="meta"><small>Industry</small><strong><?php echo htmlspecialchars($industry); ?></strong></div>
                    <div class="meta"><small>Style</small><strong><?php echo htmlspecialchars($style); ?></strong></div>
                    <div class="meta"><small>Color</small><strong><?php echo htmlspecialchars($color !== '' ? $color : 'Default Blue'); ?></strong></div>
                </div>

                <div class="meta" style="margin-top:12px;">
                    <small>Color Palette</small>
                    <div class="logo-palette">
                 <div class="logo-palette-color" style="background:<?php echo resolveBrandColor($color); ?>"></div>
                 <div class="logo-palette-color" style="background:#111827"></div>
                  <div class="logo-palette-color" style="background:#f8fafc"></div>
                 <div class="logo-palette-color" style="background:#cbd5e1"></div>
                 </div>
                </div>

                <div class="suggestions">
                    <div class="suggestion"><small>Brand Name</small><strong><?php echo htmlspecialchars($business . " Studio"); ?></strong></div>
                    <div class="suggestion"><small>Brand Name</small><strong><?php echo htmlspecialchars($business . " Co."); ?></strong></div>
                    <div class="suggestion"><small>Brand Name</small><strong><?php echo htmlspecialchars($business . " Hub"); ?></strong></div>
                </div>

                <div class="suggestions">
                    <div class="suggestion"><small>Font Pairing</small><strong>Poppins + Roboto</strong></div>
                    <div class="suggestion"><small>Font Pairing</small><strong>Montserrat + Open Sans</strong></div>
                    <div class="suggestion"><small>Font Pairing</small><strong>Playfair Display + Lato</strong></div>
                </div>

                <div class="meta" style="margin-top:12px;">
                    <small>Tagline</small>
                    <strong>Making <?php echo htmlspecialchars($business); ?> stand out.</strong>
                </div>

                <button class="secondary" type="button" onclick="downloadLogo()">⬇ Download Professional SVG</button>
            <?php else: ?>
                <div class="empty">
                    <div>
                        <div class="empty-icon">✦</div>
                        <h2>Your professional logo preview will appear here</h2>
                        <p>Enter your business details and generate a vector concept tailored to the industry you selected.</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
function downloadLogo() {
    const image = document.getElementById('logoPreview');

    if (!image) {
        alert('Please generate a logo first.');
        return;
    }

    const source = image.src;
    const base64 = source.split(',')[1];
    const svg = atob(base64);
    const blob = new Blob([svg], { type: 'image/svg+xml;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    const business = <?php echo json_encode($business ?: 'LogoVerse'); ?>;

    link.href = url;
    link.download = business.replace(/[^a-z0-9]+/gi, '-').replace(/^-|-$/g, '') + '-LogoVerse-Logo.svg';
    document.body.appendChild(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(url);
}
</script>
</body>
</html>
