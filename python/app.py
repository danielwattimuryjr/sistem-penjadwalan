from flask import Flask, request, jsonify
from solver import ClubScheduler

app = Flask(__name__)

@app.route("/solve", methods=["POST"])
def solve():
    try:
        data = request.get_json()

        if not data:
            return jsonify({"error": "Invalid or empty JSON payload"}), 400

        min_players = data.get('min_players', 3)

        print(f"Creating schedule with min_players: {min_players}")

        scheduler = ClubScheduler(min_players=min_players)
        result = scheduler.create_schedule(data)

        print(f"Generated {len(result)} scheduled sessions")

        return jsonify({
            "success": True,
            "schedule": result,
            "total_sessions": len(result)
        }), 200

    except Exception as e:
        print(f"Error in /solve: {str(e)}")
        import traceback
        traceback.print_exc()
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)