package dev.zavaletazea.ca;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

import dev.zavaletazea.ca.databinding.ActivityMainBinding;

public class MainActivity extends AppCompatActivity {

    private ActivityMainBinding binding;

    private RequestQueue conServ;
    private StringRequest petServ;

    private final String END_POINT = "https://test-cas.zavaletazea.dev/api/message";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityMainBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        conServ = Volley.newRequestQueue(this);

        //Al renderizarse el componente consumimos el servicio
        binding.srlMessage.post(new Runnable() {
            @Override
            public void run() {
                binding.srlMessage.setRefreshing(true);
                loadRemoteMessage();
            }
        });

        //En el evento swipe consumimos el servicio
        binding.srlMessage.setOnRefreshListener(() -> {
            loadRemoteMessage();
        });
    }

    /**
     * Método para consumir el servicio del mensaje
     */
    private void loadRemoteMessage() {
        petServ = new StringRequest(
            Request.Method.GET,
            END_POINT,
            new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    try {
                        JSONObject dataResponse = new JSONObject(response);

                        int responseCode = dataResponse.getInt("response_code");

                        if (responseCode == 200) {
                            final String remoteMessage = dataResponse.getString("message");
                            binding.tvMessage.setText(remoteMessage);

                        }
                    }

                    catch (Exception e) {
                        Toast.makeText(
                                MainActivity.this,
                                e.getMessage(),
                                Toast.LENGTH_SHORT
                        ).show();
                    }

                    binding.srlMessage.setRefreshing(false);
                }
            },
            new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(
                            MainActivity.this,
                            error.toString(),
                            Toast.LENGTH_SHORT
                    ).show();

                    binding.srlMessage.setRefreshing(false);
                }
            }
        );
        conServ.add(petServ);
    }
}