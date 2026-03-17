<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Extech Studio Agent Verification Result</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .wrap {
            padding: 28px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sub {
            color: #555;
            margin-bottom: 18px;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            vertical-align: middle;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 11px;
            letter-spacing: .05em;
        }

        .active {
            background: #E8F8EF;
            color: #157A3D;
            border: 1px solid #BFE9CF;
        }

        .suspended {
            background: #FDECEC;
            color: #B42318;
            border: 1px solid #F5C2C7;
        }

        .inactive {
            background: #F3F4F6;
            color: #374151;
            border: 1px solid #E5E7EB;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            border: 1px solid #E5E7EB;
            vertical-align: top;
        }

        th {
            background: #F9FAFB;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6B7280;
            width: 25%;
        }

        .section {
            margin-top: 60px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: #374151;
            margin-bottom: 8px;
        }

        .note {
            font-size: 11px;
            color: #555;
            line-height: 1.6;
        }

        .warning {
            background: #FDECEC;
            border: 1px solid #F5C2C7;
            padding: 12px;
            font-size: 11px;
            color: #7A1F1F;
            margin-top: 12px;
        }

        .info {
            background: #F3F4F6;
            border: 1px solid #E5E7EB;
            padding: 12px;
            font-size: 11px;
            color: #374151;
            margin-top: 12px;
        }
    </style>
</head>

<body>
    <div class="wrap">

        {{-- Header --}}
        <div class="title">Extech Studio Agent Verification Result</div>
        <div class="sub">
            Query: <strong>{{ $q }}</strong><br>
            Generated on: {{ $generatedAt->format('d M Y H:i') }}
        </div>

        @php
            $status = strtolower($agent->status ?? 'inactive');
            $cls = $status === 'active' ? 'active' : ($status === 'suspended' ? 'suspended' : 'inactive');
        @endphp

        <div>
            <span style="vertical-align: middle;">Status:</span>
            <span class="badge {{ $cls }}">{{ strtoupper($status) }}</span>
        </div>

        {{-- Agent Info --}}
        <table>
            <tr>
                <th>Agent ID</th>
                <td>{{ $agent->agent_code }}</td>
                <th>Full Name</th>
                <td>{{ $agent->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $agent->user->phone ?? '-' }}</td>
                <th>Official Role</th>
                <td>Agent</td>
            </tr>
            <tr>
                <th>Verification Status</th>
                <td>{{ ucfirst($status) }}</td>
                <th>Last Updated</th>
                <td>{{ optional($agent->updated_at)->format('d M Y H:i') ?? '-' }}</td>
            </tr>
        </table>

        {{-- Status Definition --}}
        <div class="section">
            <div class="section-title">Status Definitions</div>
            <div class="note">
                <strong>Active</strong> – Authorized to represent Extech Studio.<br>
                <strong>Suspended</strong> – Authorization revoked or under internal review.<br>
                <strong>Inactive</strong> – Not currently recognized as an active Extech Studio representative.
            </div>
        </div>

        {{-- Warning --}}
        @if ($status === 'suspended')
            <div class="warning">
                <strong>Safety Notice:</strong><br>
                This individual is currently suspended and is <u>not authorized</u> to conduct business on behalf of
                Extech Studio. Please do not proceed with payment or share sensitive project information.
            </div>
        @endif

        @if ($status === 'inactive')
            <div class="info">
                <strong>Notice:</strong><br>
                This individual is not currently listed as an active Extech Studio representative. Please verify through
                our official support channel before proceeding.
            </div>
        @endif

        {{-- Official Contact --}}
        <div class="section">
            <div class="section-title">Official Contact & Payment Safety</div>

            <table>
                <tr>
                    <th>Official Website</th>
                    <td>ExtechStudio.xyz</td>
                </tr>
                <tr>
                    <th>Official Support</th>
                    <td>cs.extechstudio@gmail.com</td>
                </tr>
                <tr>
                    <th>Payment Policy</th>
                    <td>
                        Payments are accepted <strong>only</strong> via official Extech Studio company bank accounts
                        or approved payment gateways.
                    </td>
                </tr>
            </table>

            <div class="note" style="margin-top:10px;">
                Extech Studio will never request payment to personal accounts, gift cards, cryptocurrency wallets,
                or unofficial transfer channels.
            </div>
        </div>

        {{-- Disclaimer --}}
        <div class="section">
            <div class="section-title">Disclaimer</div>
            <div class="note">
                This verification document is system-generated and reflects the representative’s status at the time of
                issuance.
                Authorization status may change without prior notice. Extech Studio shall not be held responsible for
                transactions conducted outside official channels.
            </div>
        </div>

    </div>
</body>

</html>